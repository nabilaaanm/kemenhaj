<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posting;
use App\Models\PostingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PostingController extends Controller
{
    public function create()
    {
        $categories = collect();
        $tableError = null;
        $postingTableError = null;

        try {
            $categories = PostingCategory::orderBy('name')->get();
        } catch (\Throwable $e) {
            $tableError = 'Tabel kategori belum tersedia. Jalankan migrasi terlebih dahulu.';
        }

        if (!Schema::hasTable('postings')) {
            $postingTableError = 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.';
        }

        return view('admin.posting.create', compact('categories', 'tableError', 'postingTableError'));
    }

    public function index()
    {
        $posts = collect();
        $postingTableError = null;

        try {
            $posts = Posting::with('category')->orderByDesc('published_at')->orderByDesc('created_at')->get();
        } catch (\Throwable $e) {
            $postingTableError = 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.';
        }

        return view('admin.posting.index', compact('posts', 'postingTableError'));
    }

    public function category()
    {
        $categories = collect();
        $tableError = null;

        try {
            $categories = PostingCategory::orderBy('name')->get();
        } catch (\Throwable $e) {
            $tableError = 'Tabel kategori belum tersedia. Jalankan migrasi terlebih dahulu.';
        }

        return view('admin.posting.category', compact('categories', 'tableError'));
    }

    public function categoryStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $baseSlug = Str::slug($data['name']);
            $slug = $baseSlug ?: Str::random(8);
            $counter = 1;
            while (PostingCategory::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            PostingCategory::create([
                'name' => $data['name'],
                'slug' => $slug,
            ]);
        } catch (\Throwable $e) {
            return back()->with('error', 'Tabel kategori belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function categoryDestroy($id)
    {
        try {
            PostingCategory::where('id', $id)->delete();
        } catch (\Throwable $e) {
            return back()->with('error', 'Tabel kategori belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    public function store(Request $request)
    {
        if (!Schema::hasTable('postings')) {
            return back()->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:posting_categories,id',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:4096',
            'editor_name' => 'nullable|string|max:255',
            'contributor_name' => 'nullable|string|max:255',
            'photographer_name' => 'nullable|string|max:255',
            'writer_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug ?: Str::random(8);
            $counter = 1;
            while (Posting::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
        } catch (\Throwable $e) {
            return back()->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $data['slug'] = $slug;
        $userRole = \Illuminate\Support\Facades\Session::get('user.role', 'kontributor');
        $data['is_active'] = $userRole === 'kontributor'
            ? false
            : $request->boolean('is_active', true);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $extension = $file->getClientOriginalExtension() ?: $file->extension();
            $filename = time() . '_' . Str::random(12) . ($extension ? '.' . $extension : '');
            $targetDir = public_path('postings');
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);
            $data['cover_image'] = $filename;
        }

        try {
            Posting::create($data);
        } catch (\Throwable $e) {
            return back()->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        return redirect()->route('admin.posting.index')->with('success', 'Posting berhasil disimpan.');
    }

    public function edit($id)
    {
        try {
            $post = Posting::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('admin.posting.index')->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }
        $categories = PostingCategory::orderBy('name')->get();

        return view('admin.posting.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Posting::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('admin.posting.index')->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:posting_categories,id',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:4096',
            'editor_name' => 'nullable|string|max:255',
            'contributor_name' => 'nullable|string|max:255',
            'photographer_name' => 'nullable|string|max:255',
            'writer_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $extension = $file->getClientOriginalExtension() ?: $file->extension();
            $filename = time() . '_' . Str::random(12) . ($extension ? '.' . $extension : '');
            $targetDir = public_path('postings');
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);
            $data['cover_image'] = $filename;
        }

        try {
            $post->update($data);
        } catch (\Throwable $e) {
            return back()->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        return redirect()->route('admin.posting.index')->with('success', 'Posting berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            Posting::where('id', $id)->delete();
        } catch (\Throwable $e) {
            return back()->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        return back()->with('success', 'Posting berhasil dihapus.');
    }
}
