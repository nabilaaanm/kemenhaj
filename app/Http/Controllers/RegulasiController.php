<?php

namespace App\Http\Controllers;

use App\Models\Regulasi;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RegulasiController extends Controller
{
    public function index(Request $request)
    {
        $activeCategory = (string) $request->query('category', 'all');
        $searchQuery = trim((string) $request->query('q', ''));

        try {
            $query = Regulasi::where('is_active', true)
                ->orderBy('regulation_date', 'desc')
                ->orderBy('created_at', 'desc');

            if ($activeCategory !== 'all' && in_array($activeCategory, Regulasi::categoryKeys(), true)) {
                $query->where('category', $activeCategory);
            } else {
                $activeCategory = 'all';
            }

            if ($searchQuery !== '') {
                $query->where('title', 'like', '%' . $searchQuery . '%');
            }

            $regulations = $query->paginate(5)->withQueryString();
        } catch (\Exception $e) {
            $regulations = new LengthAwarePaginator([], 0, 5, 1, [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);
        }

        return view('regulasi', compact('regulations', 'activeCategory', 'searchQuery'));
    }
}
