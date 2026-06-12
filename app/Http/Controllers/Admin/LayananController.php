<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $services = Layanan::orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        
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

                $iconName = \Illuminate\Support\Str::random(20) . '.' . $icon->getClientOriginalExtension();
                Storage::disk('services')->putFileAs('', $icon, $iconName);
                $data['icon'] = 'services/' . $iconName;
            }

            Layanan::create($data);

            return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan layanan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($name)
    {
        $service = Layanan::findOrFail(urldecode($name));
        return view('admin.layanan.edit', compact('service'));
    }

    public function update(Request $request, $name)
    {
        $service = Layanan::findOrFail(urldecode($name));

        $request->validate([
            'name' => 'required|string|max:255|unique:layanan,name,' . $service->name . ',name',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'icon' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'name.required' => 'Nama layanan wajib diisi',
            'name.unique' => 'Nama layanan sudah digunakan',
            'url.required' => 'URL layanan wajib diisi',
            'url.url' => 'URL tidak valid',
            'icon.image' => 'Icon harus berupa gambar',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'url' => $request->url,
                'is_active' => $service->is_active,
            ];

            // Handle icon upload
            if ($request->hasFile('icon')) {
                // Delete old icon
                if ($service->icon && str_starts_with($service->icon, 'services/')) {
                    $oldName = substr($service->icon, strlen('services/'));
                    if ($oldName !== '') {
                        Storage::disk('services')->delete($oldName);
                    }
                }
                
                $icon = $request->file('icon');

                $iconName = \Illuminate\Support\Str::random(20) . '.' . $icon->getClientOriginalExtension();
                Storage::disk('services')->putFileAs('', $icon, $iconName);
                $data['icon'] = 'services/' . $iconName;
            } elseif ($service->icon) {
                $data['icon'] = $service->icon;
            }

            if ($request->name !== $service->name) {
                $service->delete();
                Layanan::create($data);
            } else {
                $service->update($data);
            }

            return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui layanan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($name)
    {
        try {
            $service = Layanan::findOrFail(urldecode($name));
            
            // Delete icon if exists
            if ($service->icon && str_starts_with($service->icon, 'services/')) {
                $oldName = substr($service->icon, strlen('services/'));
                if ($oldName !== '') {
                    Storage::disk('services')->delete($oldName);
                }
            }
            
            $service->delete();

            return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus layanan: ' . $e->getMessage());
        }
    }
}
