<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Collection;
use App\Models\CollectionTag;
use App\Models\ContactRequest;
use App\Models\FooterLanguage;
use App\Models\FooterLink;
use App\Models\FooterSetting;
use App\Models\Hadith;
use App\Models\HadithNarrator;
use App\Models\HeaderNavigation;
use App\Models\HeaderSetting;
use App\Models\Media;
use App\Models\Page;
use App\Models\Scholar;
use App\Models\Topic;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create header settings
        $headerSetting = HeaderSetting::create([
            'site_title' => 'Mehere Hussain',
            'tagline' => 'The Hadith of the Prophet Muhammad (صلى الله عليه و سلم) at your fingertips',
        ]);

        HeaderNavigation::create([
            'header_setting_id' => $headerSetting->id,
            'label' => 'Collections',
            'link' => '/collections',
            'order' => 1,
        ]);

        HeaderNavigation::create([
            'header_setting_id' => $headerSetting->id,
            'label' => 'Scholars',
            'link' => '/scholars',
            'order' => 2,
        ]);

        HeaderNavigation::create([
            'header_setting_id' => $headerSetting->id,
            'label' => 'Topics',
            'link' => '/topics',
            'order' => 3,
        ]);

        HeaderNavigation::create([
            'header_setting_id' => $headerSetting->id,
            'label' => 'Contact',
            'link' => '/contact',
            'order' => 4,
        ]);

        // Create footer settings
        $footerSetting = FooterSetting::create([
            'about_text' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'A comprehensive Islamic reference website providing access to authentic hadith collections.',
                            ],
                        ],
                    ],
                ],
            ],
            'contact_email' => 'contact@meherehussain.com',
            'contact_address' => '123 Islamic Street, Knowledge City',
            'contact_phone' => '+1234567890',
            'donate_link' => '/donate',
        ]);

        FooterLink::create([
            'footer_setting_id' => $footerSetting->id,
            'label' => 'About',
            'link' => '/about',
            'order' => 1,
        ]);

        FooterLink::create([
            'footer_setting_id' => $footerSetting->id,
            'label' => 'Privacy Policy',
            'link' => '/privacy',
            'order' => 2,
        ]);

        FooterLanguage::create([
            'footer_setting_id' => $footerSetting->id,
            'language' => 'Arabic',
            'order' => 1,
        ]);

        FooterLanguage::create([
            'footer_setting_id' => $footerSetting->id,
            'language' => 'English',
            'order' => 2,
        ]);

        FooterLanguage::create([
            'footer_setting_id' => $footerSetting->id,
            'language' => 'Urdu',
            'order' => 3,
        ]);

        FooterLanguage::create([
            'footer_setting_id' => $footerSetting->id,
            'language' => 'Hindi',
            'order' => 4,
        ]);

        FooterLanguage::create([
            'footer_setting_id' => $footerSetting->id,
            'language' => 'Hinglish',
            'order' => 5,
        ]);

        // Create scholars
        $scholars = Scholar::factory()->count(5)->create();

        // Create collections for each scholar
        foreach ($scholars as $scholar) {
            $collections = Collection::factory()->count(2)->create([
                'scholar_id' => $scholar->id,
            ]);

            foreach ($collections as $collection) {
                // Add tags to collections
                CollectionTag::factory()->count(3)->create([
                    'collection_id' => $collection->id,
                ]);

                // Create books for each collection
                $books = Book::factory()->count(3)->create([
                    'collection_id' => $collection->id,
                ]);

                foreach ($books as $book) {
                    // Create chapters for each book
                    $chapters = Chapter::factory()->count(5)->create([
                        'book_id' => $book->id,
                    ]);

                    foreach ($chapters as $chapter) {
                        // Create hadith for each chapter
                        $hadiths = Hadith::factory()->count(10)->create([
                            'collection_id' => $collection->id,
                            'book_id' => $book->id,
                            'chapter_id' => $chapter->id,
                        ]);

                        foreach ($hadiths as $hadith) {
                            // Add narrators to hadith
                            HadithNarrator::factory()->count(2)->create([
                                'hadith_id' => $hadith->id,
                            ]);
                        }
                    }
                }
            }
        }

        // Create topics
        $topics = Topic::factory()->count(10)->create();

        // Attach topics to hadith
        $hadiths = Hadith::all();
        foreach ($hadiths as $hadith) {
            $hadith->topics()->attach($topics->random(rand(1, 3)));
        }

        // Create pages
        Page::factory()->create([
            'title' => 'About',
            'slug' => 'about',
        ]);

        Page::factory()->create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy',
        ]);

        // Create some contact requests
        ContactRequest::factory()->count(5)->create();
    }
}
