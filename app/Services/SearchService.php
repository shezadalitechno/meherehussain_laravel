<?php

namespace App\Services;

use App\Models\Hadith;
use Illuminate\Support\Collection;

class SearchService
{
    /**
     * Parse search query and extract components
     */
    public function parseQuery(string $query): array
    {
        $parsed = [
            'exact_phrases' => [],
            'terms' => [],
            'excluded_terms' => [],
            'wildcards' => [],
        ];

        // Extract quoted phrases (exact matches)
        preg_match_all('/"([^"]+)"/', $query, $quotedMatches);
        $parsed['exact_phrases'] = $quotedMatches[1] ?? [];
        
        // Remove quoted phrases from query for further processing
        $queryWithoutQuotes = preg_replace('/"[^"]+"/', '', $query);
        
        // Extract NOT terms
        preg_match_all('/\bNOT\s+(\S+)/i', $queryWithoutQuotes, $notMatches);
        $parsed['excluded_terms'] = $notMatches[1] ?? [];
        
        // Remove NOT terms
        $queryWithoutNot = preg_replace('/\bNOT\s+\S+/i', '', $queryWithoutQuotes);
        
        // Extract wildcard terms (ending with *)
        preg_match_all('/(\S+)\*/', $queryWithoutNot, $wildcardMatches);
        $parsed['wildcards'] = $wildcardMatches[1] ?? [];
        
        // Remove wildcards
        $queryWithoutWildcards = preg_replace('/\S+\*/', '', $queryWithoutNot);
        
        // Extract remaining terms (split by spaces, remove AND/OR operators)
        $terms = preg_split('/\s+(?:AND|OR)\s+/i', $queryWithoutWildcards);
        $parsed['terms'] = array_filter(array_map('trim', $terms), fn($term) => !empty($term) && !in_array(strtoupper($term), ['AND', 'OR', 'NOT']));
        
        return $parsed;
    }

    /**
     * Search hadith using parsed query
     */
    public function search(string $query, int $limit = 50): Collection
    {
        $parsed = $this->parseQuery($query);
        
        $hadithQuery = Hadith::query()->with(['collection', 'book', 'chapter']);
        
        // Search in reference number
        if (!empty($parsed['terms'])) {
            foreach ($parsed['terms'] as $term) {
                $hadithQuery->where(function($q) use ($term) {
                    $q->where('reference_number', 'like', "%{$term}%")
                      ->orWhereHas('collection', function($q) use ($term) {
                          $q->where('title', 'like', "%{$term}%");
                      })
                      ->orWhereHas('book', function($q) use ($term) {
                          $q->where('title', 'like', "%{$term}%");
                      })
                      ->orWhereHas('chapter', function($q) use ($term) {
                          $q->where('title', 'like', "%{$term}%");
                      });
                });
            }
        }
        
        // Exact phrase matching
        foreach ($parsed['exact_phrases'] as $phrase) {
            $hadithQuery->where(function($q) use ($phrase) {
                $q->where('reference_number', 'like', "%{$phrase}%")
                  ->orWhereHas('collection', function($q) use ($phrase) {
                      $q->where('title', 'like', "%{$phrase}%");
                  });
            });
        }
        
        // Wildcard matching
        foreach ($parsed['wildcards'] as $wildcard) {
            $hadithQuery->where(function($q) use ($wildcard) {
                $q->where('reference_number', 'like', "{$wildcard}%")
                  ->orWhereHas('collection', function($q) use ($wildcard) {
                      $q->where('title', 'like', "{$wildcard}%");
                  });
            });
        }
        
        // Exclude terms
        foreach ($parsed['excluded_terms'] as $excluded) {
            $hadithQuery->where(function($q) use ($excluded) {
                $q->where('reference_number', 'not like', "%{$excluded}%")
                  ->whereDoesntHave('collection', function($q) use ($excluded) {
                      $q->where('title', 'like', "%{$excluded}%");
                  });
            });
        }
        
        return $hadithQuery->limit($limit)->get();
    }

    /**
     * Format search results with previews
     */
    public function formatResults(Collection $results, string $query): array
    {
        $parsed = $this->parseQuery($query);
        $allSearchTerms = array_merge(
            $parsed['terms'],
            $parsed['exact_phrases'],
            $parsed['wildcards']
        );
        
        return $results->map(function ($hadith) use ($allSearchTerms) {
            $preview = $this->generatePreview($hadith, $allSearchTerms);
            
            return [
                'id' => $hadith->id,
                'reference_number' => $hadith->reference_number,
                'collection' => $hadith->collection->title,
                'book' => $hadith->book->title,
                'chapter' => $hadith->chapter->title,
                'grade' => $hadith->grade,
                'preview' => $preview,
                'url' => route('hadith.show', $hadith),
            ];
        })->toArray();
    }

    /**
     * Generate text preview from hadith content
     */
    protected function generatePreview($hadith, array $terms): string
    {
        // Extract text from English translation
        $text = $hadith->extractTextFromTipTap($hadith->text_english);
        
        if (empty($text)) {
            return '';
        }
        
        // Find first occurrence of any search term
        $position = -1;
        foreach ($terms as $term) {
            $pos = stripos($text, $term);
            if ($pos !== false && ($position === -1 || $pos < $position)) {
                $position = $pos;
            }
        }
        
        if ($position === -1) {
            return substr($text, 0, 150) . '...';
        }
        
        // Extract context around the match
        $start = max(0, $position - 50);
        $length = min(strlen($text) - $start, 200);
        $preview = substr($text, $start, $length);
        
        if ($start > 0) {
            $preview = '...' . $preview;
        }
        if ($start + $length < strlen($text)) {
            $preview = $preview . '...';
        }
        
        return $preview;
    }
}

