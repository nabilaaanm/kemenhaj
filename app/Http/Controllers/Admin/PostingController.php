<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posting;
use App\Models\PostingKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class PostingController extends Controller
{
    public function create()
    {
        $categories = collect();
        $tableError = null;
        $postingTableError = null;

        try {
            $categories = PostingKategori::orderBy('name')->get();
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
        $posts = new LengthAwarePaginator([], 0, 10, 1, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
        $postingTableError = null;
        $pendingContributorCount = 0;

        try {
            $posts = Posting::with('category')
                ->orderByRaw("CASE WHEN submitted_by_role = 'kontributor' AND is_active = 0 THEN 0 ELSE 1 END")
                ->orderByDesc('created_at')
                ->paginate(10)
                ->withQueryString();

            $pendingContributorCount = Posting::where('submitted_by_role', 'kontributor')
                ->where('is_active', false)
                ->count();
        } catch (\Throwable $e) {
            $postingTableError = 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.';
        }

        return view('admin.posting.index', compact('posts', 'postingTableError', 'pendingContributorCount'));
    }

    public function category()
    {
        $categories = new LengthAwarePaginator([], 0, 10, 1, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
        $tableError = null;

        try {
            $categories = PostingKategori::orderBy('name')->paginate(10)->withQueryString();
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
            while (PostingKategori::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            PostingKategori::create([
                'name' => $data['name'],
                'slug' => $slug,
            ]);
        } catch (\Throwable $e) {
            return back()->with('error', 'Tabel kategori belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function categoryDestroy($slug)
    {
        try {
            PostingKategori::where('slug', urldecode($slug))->delete();
        } catch (\Throwable $e) {
            return back()->with('error', 'Tabel kategori belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Unggah gambar untuk editor TinyMCE (bukan base64 di HTML) agar konten tidak terpotong oleh batas post_max_size.
     */
    public function uploadEditorImage(Request $request)
    {
        if (!Schema::hasTable('postings')) {
            return response()->json(['error' => 'Tabel posting belum tersedia.'], 503);
        }

        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'file.required' => 'Berkas gambar wajib diunggah.',
            'file.image' => 'Berkas harus berupa gambar.',
            'file.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension() ?: $file->extension();
        $filename = time() . '_' . Str::random(12) . ($extension ? '.' . $extension : '');

        Storage::disk('postings')->putFileAs('', $file, $filename);

        $url = Storage::disk('postings')->url($filename);

        return response()->json(['location' => $url]);
    }

    public function store(Request $request)
    {
        if (!Schema::hasTable('postings')) {
            return back()->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_slug' => 'nullable|exists:posting_kategori,slug',
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
        $data['submitted_by_role'] = $userRole;
        $data['submitted_by_name'] = \Illuminate\Support\Facades\Session::get('user.name');

        if ($userRole === 'editor') {
            $data['is_active'] = $request->boolean('is_active');
        } elseif ($userRole === 'admin') {
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        }

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $extension = $file->getClientOriginalExtension() ?: $file->extension();
            $filename = time() . '_' . Str::random(12) . ($extension ? '.' . $extension : '');
            Storage::disk('postings')->putFileAs('', $file, $filename);
            $data['cover_image'] = $filename;
        }

        try {
            Posting::create($data);
        } catch (\Throwable $e) {
            return back()->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        return redirect()->route('admin.posting.index')->with(
            'success',
            $userRole === 'kontributor'
                ? 'Posting berhasil disimpan dan menunggu persetujuan editor/admin.'
                : 'Posting berhasil disimpan.'
        );
    }

    public function edit($id)
    {
        try {
            $post = Posting::findOrFail($id);
        } catch (\Throwable $e) {
            return redirect()->route('admin.posting.index')->with('error', 'Tabel posting belum tersedia. Jalankan migrasi terlebih dahulu.');
        }
        $categories = PostingKategori::orderBy('name')->get();

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
            'category_slug' => 'nullable|exists:posting_kategori,slug',
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

        $userRole = \Illuminate\Support\Facades\Session::get('user.role', 'kontributor');
        if (in_array($userRole, ['editor', 'admin'], true)) {
            $data['is_active'] = $request->boolean('is_active');
        } else {
            $data['is_active'] = $post->is_active;
        }

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $extension = $file->getClientOriginalExtension() ?: $file->extension();
            $filename = time() . '_' . Str::random(12) . ($extension ? '.' . $extension : '');
            Storage::disk('postings')->putFileAs('', $file, $filename);
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

    public function toggleActive(Request $request, $id)
    {
        $userRole = \Illuminate\Support\Facades\Session::get('user.role', 'kontributor');
        if (!in_array($userRole, ['admin', 'editor'], true)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Akses ditolak.'], 403);
            }

            return back()->with('error', 'Akses ditolak.');
        }

        try {
            $post = Posting::findOrFail($id);
        } catch (\Throwable $e) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Posting tidak ditemukan.'], 404);
            }

            return back()->with('error', 'Posting tidak ditemukan.');
        }

        $post->is_active = !$post->is_active;
        $post->save();

        $message = $post->is_active
            ? 'Posting "' . $post->title . '" berhasil diaktifkan.'
            : 'Posting "' . $post->title . '" berhasil dinonaktifkan.';

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'is_active' => $post->is_active,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }
}
