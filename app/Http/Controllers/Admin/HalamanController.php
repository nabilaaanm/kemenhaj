<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HalamanController extends Controller
{
    private function makeUniqueSlug(string $title, ?string $currentId = null): string
    {
        $base = Str::slug($title);
        $slug = $base !== '' ? $base : 'halaman';
        $counter = 1;
        while (
            CustomPage::where('slug', $slug)
                ->when($currentId, fn($q) => $q->where('id', '!=', $currentId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }
        return $slug;
    }

    public function create()
    {
        return view('admin.halaman.create');
    }

    public function index()
    {
        $pages = CustomPage::orderBy('group')
            ->orderBy('order')
            ->orderByDesc('id')
            ->get();
        return view('admin.halaman.index', compact('pages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'group' => 'required|in:header,berita,galeri,profil,layanan,data-informasi,lk-pih,regulasi',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'contributor' => 'nullable|string|max:255',
            'editor' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'photographer' => 'nullable|string|max:255',
            'other_info' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : $this->makeUniqueSlug($request->title);

        $data = $request->only([
            'title',
            'group',
            'description',
            'content',
            'contributor',
            'editor',
            'source',
            'photographer',
            'other_info',
        ]);
        $data['slug'] = $slug;
        $data['order'] = $request->order ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('pages');
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);
            $data['cover_image'] = $filename;
        }

        CustomPage::create($data);

        return redirect()->route('admin.halaman.index')
            ->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $page = CustomPage::findOrFail($id);
        return view('admin.halaman.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = CustomPage::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'group' => 'required|in:header,berita,galeri,profil,layanan,data-informasi,lk-pih,regulasi',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'contributor' => 'nullable|string|max:255',
            'editor' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'photographer' => 'nullable|string|max:255',
            'other_info' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $slug = $request->slug
            ? Str::slug($request->slug)
            : $this->makeUniqueSlug($request->title, $page->id);

        $data = $request->only([
            'title',
            'group',
            'description',
            'content',
            'contributor',
            'editor',
            'source',
            'photographer',
            'other_info',
        ]);
        $data['slug'] = $slug;
        $data['order'] = $request->order ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            if ($page->cover_image) {
                $oldPath = public_path('pages/' . $page->cover_image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $file = $request->file('cover_image');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('pages');
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);
            $data['cover_image'] = $filename;
        }

        $page->update($data);

        return redirect()->route('admin.halaman.index')
            ->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $page = CustomPage::findOrFail($id);
        if ($page->cover_image) {
            $oldPath = public_path('pages/' . $page->cover_image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }
        $page->delete();

        return redirect()->route('admin.halaman.index')
            ->with('success', 'Halaman berhasil dihapus.');
    }
}
