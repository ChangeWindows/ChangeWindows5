<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Release;
use App\Log;
use App\Milestone;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller {
    public function index() {
        return view('core.search.index');
    }

    public function results(Request $request) {
        $search_results = (new Search())
            ->registerModel(User::class, 'name')
            ->registerModel(Release::class, 'build', 'delta')
            ->registerModel(Log::class, 'changelog')
            ->registerModel(Milestone::class, 'version')
            ->perform($request->input('search'));

        return view('core.search.results', compact('search_results'));
    }
}
