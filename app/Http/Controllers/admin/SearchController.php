<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller {
    public function index() {
        return view('core.search.index');
    }

    public function results(Request $request) {
        $search_results = (new Search())
            ->registerModel(User::class, 'name')
            ->perform($request->input('search'));

        return view('core.search.results', compact('search_results'));
    }
}
