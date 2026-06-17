<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;

class SlideshowController extends Controller
{
    public function index()
    {
        if (!Schema::hasTable('slideshows')) {
            return view('admin.pengaturan.slideshow', [
                'slides' => new LengthAwarePaginator([], 0, 10, 1, [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]),
            ])->with('warning', 'Tabel slideshow belum dibuat. Silakan jalankan migrasi terlebih dahulu.');
        }

        $slides = Slideshow::orderBy('created_at')->orderBy('title')->paginate(10)->withQueryString();
        return view('admin.pengaturan.slideshow', compact('slides'));
    }

    public function create()
    {
        return view('admin.pengaturan.slideshow-create');
    }

    public function store(Request $request)
    {
        if (!Schema::hasTable('slideshows')) {
            return back()->with('warning', 'Tabel slideshow belum dibuat. Jalankan migrasi terlebih dahulu.');
        }

        $request->validate([
            'title' => 'required|string|max:255|unique:slideshows,title',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'title',
            'description',
            'button_text',
            'button_url',
        ]);
        $data['order'] = (int) (Slideshow::max('order') ?? 0) + 1;
        $data['is_active'] = $request->boolean('is_active');

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension() ?: $file->extension();
        $filename = time() . '_' . Str::random(12) . ($extension ? '.' . $extension : '');
        Storage::disk('slideshows')->putFileAs('', $file, $filename);
        $data['image_path'] = $filename;

        Slideshow::create($data);

        return redirect()->route('admin.pengaturan.slideshow')
            ->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit($title)
    {
        if (!Schema::hasTable('slideshows')) {
            return redirect()->route('admin.pengaturan.slideshow')
                ->with('warning', 'Tabel slideshow belum dibuat. Jalankan migrasi terlebih dahulu.');
        }

        $slide = Slideshow::findOrFail(urldecode($title));
        return view('admin.pengaturan.slideshow-edit', compact('slide'));
    }

    public function update(Request $request, $title)
    {
        if (!Schema::hasTable('slideshows')) {
            return redirect()->route('admin.pengaturan.slideshow')
                ->with('warning', 'Tabel slideshow belum dibuat. Jalankan migrasi terlebih dahulu.');
        }

        $slide = Slideshow::findOrFail(urldecode($title));

        $request->validate([
            'title' => 'required|string|max:255|unique:slideshows,title,' . $slide->title . ',title',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'title',
            'description',
            'button_text',
            'button_url',
        ]);
        $data['order'] = $slide->order;
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if (!empty($slide->image_path)) {
                Storage::disk('slideshows')->delete($slide->image_path);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension() ?: $file->extension();
            $filename = time() . '_' . Str::random(12) . ($extension ? '.' . $extension : '');
            Storage::disk('slideshows')->putFileAs('', $file, $filename);
            $data['image_path'] = $filename;
        }

        if ($data['title'] !== $slide->title) {
            if (!isset($data['image_path'])) {
                $data['image_path'] = $slide->image_path;
            }
            $slide->delete();
            Slideshow::create($data);
        } else {
            $slide->update($data);
        }

        return redirect()->route('admin.pengaturan.slideshow')
            ->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy($title)
    {
        if (!Schema::hasTable('slideshows')) {
            return redirect()->route('admin.pengaturan.slideshow')
                ->with('warning', 'Tabel slideshow belum dibuat. Jalankan migrasi terlebih dahulu.');
        }

        $slide = Slideshow::findOrFail(urldecode($title));
        if (!empty($slide->image_path)) {
            Storage::disk('slideshows')->delete($slide->image_path);
        }
        $slide->delete();

        return redirect()->route('admin.pengaturan.slideshow')
            ->with('success', 'Slide berhasil dihapus.');
    }

    public function toggleActive(Request $request, $title)
    {
        if (!Schema::hasTable('slideshows')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Tabel slideshow belum dibuat.'], 422);
            }

            return back()->with('warning', 'Tabel slideshow belum dibuat. Jalankan migrasi terlebih dahulu.');
        }

        $slide = Slideshow::findOrFail(urldecode($title));
        $slide->is_active = !$slide->is_active;
        $slide->save();

        $message = $slide->is_active
            ? 'Slide "' . $slide->title . '" berhasil diaktifkan.'
            : 'Slide "' . $slide->title . '" berhasil dinonaktifkan.';

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'is_active' => $slide->is_active,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }
}
