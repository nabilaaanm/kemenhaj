<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $services = Service::where('is_active', true)
                ->orderBy('order', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $services = collect([]);
        }
        
        return view('layanan', compact('services'));
    }
}
