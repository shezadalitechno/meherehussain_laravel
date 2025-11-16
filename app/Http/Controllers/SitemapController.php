<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Hadith;
use App\Models\Page;
use App\Models\Scholar;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $collections = Collection::all();
        $scholars = Scholar::all();
        $topics = Topic::all();
        $pages = Page::all();
        $hadith = Hadith::all();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Homepage
        $xml .= $this->urlElement(url('/'), now(), '1.0', 'daily');

        // Collections
        foreach ($collections as $collection) {
            $xml .= $this->urlElement(
                route('collections.show', $collection),
                $collection->updated_at,
                '0.8',
                'weekly'
            );
        }

        // Scholars
        foreach ($scholars as $scholar) {
            $xml .= $this->urlElement(
                route('scholars.show', $scholar),
                $scholar->updated_at,
                '0.7',
                'monthly'
            );
        }

        // Topics
        foreach ($topics as $topic) {
            $xml .= $this->urlElement(
                route('topics.show', $topic),
                $topic->updated_at,
                '0.7',
                'weekly'
            );
        }

        // Pages
        foreach ($pages as $page) {
            $xml .= $this->urlElement(
                route('pages.show', $page),
                $page->updated_at,
                '0.5',
                'monthly'
            );
        }

        // Hadith
        foreach ($hadith as $item) {
            $xml .= $this->urlElement(
                route('hadith.show', $item),
                $item->updated_at,
                '0.9',
                'weekly'
            );
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    private function urlElement($url, $lastmod, $priority, $changefreq): string
    {
        return "  <url>\n" .
               "    <loc>" . htmlspecialchars($url) . "</loc>\n" .
               "    <lastmod>" . $lastmod->toAtomString() . "</lastmod>\n" .
               "    <priority>" . $priority . "</priority>\n" .
               "    <changefreq>" . $changefreq . "</changefreq>\n" .
               "  </url>\n";
    }
}

