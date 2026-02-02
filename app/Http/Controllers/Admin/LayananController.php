<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.layanan.index', compact('services'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'icon' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'name.required' => 'Nama layanan wajib diisi',
            'url.required' => 'URL layanan wajib diisi',
            'url.url' => 'URL tidak valid',
            'icon.image' => 'Icon harus berupa gambar',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'url' => $request->url,
                'is_active' => true,
            ];

            // Handle icon upload
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                
                // Ensure directory exists
                $directory = public_path('services');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                $iconName = 'services/' . \Illuminate\Support\Str::random(20) . '.' . $icon->getClientOriginalExtension();
                $icon->move($directory, basename($iconName));
                $data['icon'] = $iconName;
            }

            Service::create($data);

            return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan layanan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.layanan.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'icon' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'name.required' => 'Nama layanan wajib diisi',
            'url.required' => 'URL layanan wajib diisi',
            'url.url' => 'URL tidak valid',
            'icon.image' => 'Icon harus berupa gambar',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'url' => $request->url,
            ];

            // Handle icon upload
            if ($request->hasFile('icon')) {
                // Delete old icon
                if ($service->icon && file_exists(public_path($service->icon))) {
                    unlink(public_path($service->icon));
                }
                
                $icon = $request->file('icon');
                
                // Ensure directory exists
                $directory = public_path('services');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                $iconName = 'services/' . \Illuminate\Support\Str::random(20) . '.' . $icon->getClientOriginalExtension();
                $icon->move($directory, basename($iconName));
                $data['icon'] = $iconName;
            }

            $service->update($data);

            return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui layanan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            
            // Delete icon if exists
            if ($service->icon && file_exists(public_path($service->icon))) {
                unlink(public_path($service->icon));
            }
            
            $service->delete();

            return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus layanan: ' . $e->getMessage());
        }
    }
}
