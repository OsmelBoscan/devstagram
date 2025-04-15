<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Buscar usuarios únicamente por username
        $users = User::where('username', 'LIKE', "%{$query}%")->get();

        return view('search.results', [
            'users' => $users,
            'query' => $query
        ]);
    }
}
