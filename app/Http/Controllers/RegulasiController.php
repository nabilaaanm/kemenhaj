<?php

namespace App\Http\Controllers;

use App\Models\Regulasi;
use Illuminate\Http\Request;

class RegulasiController extends Controller
{
    public function index()
    {
        try {
            $regulations = Regulasi::where('is_active', true)
                ->orderBy('regulation_date', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $regulations = collect([]);
        }
        
        return view('regulasi', compact('regulasi'));
    }
}
