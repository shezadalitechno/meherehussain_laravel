<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        protected SearchService $searchService
    ) {}

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return response()->json([
                'error' => 'Query parameter "q" is required'
            ], 400);
        }

        $hadithResults = $this->searchService->search($query, 50);
        $results = $this->searchService->formatResults($hadithResults, $query);

        return response()->json([
            'results' => $results,
            'count' => count($results),
        ]);
    }
}

