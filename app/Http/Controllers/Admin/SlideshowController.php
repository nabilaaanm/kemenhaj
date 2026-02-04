<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SlideshowController extends Controller
{
    public function index()
    {
        if (!Schema::hasTable('slideshows')) {
            return view('admin.pengaturan.slideshow', [
                'slides' => collect(),
            ])->with('warning', 'Tabel slideshow belum dibuat. Silakan jalankan migrasi terlebih dahulu.');
        }

        $slides = Slideshow::orderBy('order')->orderBy('id')->get();
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
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'order' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('slideshows', 'order'),
            ],
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'title',
            'badge',
            'description',
            'button_text',
            'button_url',
            'order',
        ]);
        $data['order'] = $data['order'];
        $data['is_active'] = $request->boolean('is_active', true);

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension() ?: $file->extension();
        $filename = time() . '_' . Str::random(12) . ($extension ? '.' . $extension : '');
        Storage::disk('slideshows')->putFileAs('', $file, $filename);
        $data['image_path'] = $filename;

        Slideshow::create($data);

        return redirect()->route('admin.pengaturan.slideshow')
            ->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (!Schema::hasTable('slideshows')) {
            return redirect()->route('admin.pengaturan.slideshow')
                ->with('warning', 'Tabel slideshow belum dibuat. Jalankan migrasi terlebih dahulu.');
        }

        $slide = Slideshow::findOrFail($id);
        return view('admin.pengaturan.slideshow-edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        if (!Schema::hasTable('slideshows')) {
            return redirect()->route('admin.pengaturan.slideshow')
                ->with('warning', 'Tabel slideshow belum dibuat. Jalankan migrasi terlebih dahulu.');
        }

        $slide = Slideshow::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'order' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('slideshows', 'order')->ignore($slide->id),
            ],
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'title',
            'badge',
            'description',
            'button_text',
            'button_url',
            'order',
        ]);
        $data['order'] = $data['order'];
        $data['is_active'] = $request->boolean('is_active', true);

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

        $slide->update($data);

        return redirect()->route('admin.pengaturan.slideshow')
            ->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!Schema::hasTable('slideshows')) {
            return redirect()->route('admin.pengaturan.slideshow')
                ->with('warning', 'Tabel slideshow belum dibuat. Jalankan migrasi terlebih dahulu.');
        }

        $slide = Slideshow::findOrFail($id);
        if (!empty($slide->image_path)) {
            Storage::disk('slideshows')->delete($slide->image_path);
        }
        $slide->delete();

        return redirect()->route('admin.pengaturan.slideshow')
            ->with('success', 'Slide berhasil dihapus.');
    }
}
