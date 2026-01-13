<?php

namespace App\Http\Controllers;

use App\Models\Regulation;
use Illuminate\Http\Request;

class RegulasiController extends Controller
{
    public function index()
    {
        try {
            $regulations = Regulation::where('is_active', true)
                ->orderBy('order', 'asc')
                ->orderBy('regulation_date', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $regulations = collect([]);
        }
        
        return view('regulasi', compact('regulations'));
    }
}
