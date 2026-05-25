<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HalamanController extends Controller
{
    private function makeUniqueSlug(string $title, ?string $currentSlug = null): string
    {
        $base = Str::slug($title);
        $slug = $base !== '' ? $base : 'halaman';
        $counter = 1;
        while (
            CustomPage::where('slug', $slug)
                ->when($currentSlug, fn($q) => $q->where('slug', '!=', $currentSlug))
                ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }
        return $slug;
    }

    private function nextOrderForGroup(string $group): int
    {
        $max = CustomPage::where('group', $group)->max('order');

        return (int) ($max ?? 0) + 1;
    }

    public function create()
    {
        return view('admin.halaman.create');
    }

    public function index()
    {
        $pages = CustomPage::orderBy('group')
            ->orderBy('order')
            ->orderByDesc('slug')
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
        $data['order'] = $this->nextOrderForGroup($request->group);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('pages')->putFileAs('', $file, $filename);
            $data['cover_image'] = $filename;
        }

        CustomPage::create($data);

        return redirect()->route('admin.halaman.index')
            ->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit($slug)
    {
        $page = CustomPage::findOrFail($slug);
        return view('admin.halaman.edit', compact('page'));
    }

    public function update(Request $request, $slug)
    {
        $page = CustomPage::findOrFail($slug);

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
            'is_active' => 'nullable|boolean',
        ]);

        $slug = $request->slug
            ? Str::slug($request->slug)
            : $this->makeUniqueSlug($request->title, $page->slug);

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
        if ($request->group !== $page->group) {
            $data['order'] = $this->nextOrderForGroup($request->group);
        }
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            if ($page->cover_image) {
                Storage::disk('pages')->delete($page->cover_image);
            }
            $file = $request->file('cover_image');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('pages')->putFileAs('', $file, $filename);
            $data['cover_image'] = $filename;
        }

        $newSlug = $data['slug'];
        if ($newSlug !== $page->slug) {
            $page->delete();
            CustomPage::create($data);
        } else {
            $page->update($data);
        }

        return redirect()->route('admin.halaman.index')
            ->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy($slug)
    {
        $page = CustomPage::findOrFail($slug);
        if ($page->cover_image) {
            Storage::disk('pages')->delete($page->cover_image);
        }
        $page->delete();

        return redirect()->route('admin.halaman.index')
            ->with('success', 'Halaman berhasil dihapus.');
    }
}
