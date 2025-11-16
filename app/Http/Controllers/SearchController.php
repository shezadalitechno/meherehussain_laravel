<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        protected SearchService $searchService
    ) {}

    public function index(Request $request)
    {
        $query = $request->get('q');
        $results = collect();

        if ($query) {
            $hadithResults = $this->searchService->search($query, 50);
            $results = $this->searchService->formatResults($hadithResults, $query);
            $results = new \Illuminate\Pagination\LengthAwarePaginator(
                $results,
                count($results),
                20,
                $request->get('page', 1),
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        return view('search.index', compact('results', 'query'));
    }
}

