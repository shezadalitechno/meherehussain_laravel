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
use App\Models\Page;
use App\Models\Scholar;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create header settings
        $headerSetting = HeaderSetting::firstOrCreate(
            ['id' => 1],
            [
                'site_title' => 'Mehere Hussain',
                'tagline' => 'The Hadith of the Prophet Muhammad (صلى الله عليه و سلم) at your fingertips',
            ]
        );

        HeaderNavigation::firstOrCreate(
            ['header_setting_id' => $headerSetting->id, 'label' => 'Collections'],
            ['link' => '/collections', 'order' => 1]
        );

        HeaderNavigation::firstOrCreate(
            ['header_setting_id' => $headerSetting->id, 'label' => 'Scholars'],
            ['link' => '/scholars', 'order' => 2]
        );

        HeaderNavigation::firstOrCreate(
            ['header_setting_id' => $headerSetting->id, 'label' => 'Topics'],
            ['link' => '/topics', 'order' => 3]
        );

        HeaderNavigation::firstOrCreate(
            ['header_setting_id' => $headerSetting->id, 'label' => 'Contact'],
            ['link' => '/contact', 'order' => 4]
        );

        // Create footer settings
        $footerSetting = FooterSetting::firstOrCreate(
            ['id' => 1],
            [
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
            ]
        );

        FooterLink::firstOrCreate(
            ['footer_setting_id' => $footerSetting->id, 'label' => 'About'],
            ['link' => '/about', 'order' => 1]
        );

        FooterLink::firstOrCreate(
            ['footer_setting_id' => $footerSetting->id, 'label' => 'Privacy Policy'],
            ['link' => '/privacy', 'order' => 2]
        );

        FooterLanguage::firstOrCreate(
            ['footer_setting_id' => $footerSetting->id, 'language' => 'Arabic'],
            ['order' => 1]
        );

        FooterLanguage::firstOrCreate(
            ['footer_setting_id' => $footerSetting->id, 'language' => 'English'],
            ['order' => 2]
        );

        FooterLanguage::firstOrCreate(
            ['footer_setting_id' => $footerSetting->id, 'language' => 'Urdu'],
            ['order' => 3]
        );

        FooterLanguage::firstOrCreate(
            ['footer_setting_id' => $footerSetting->id, 'language' => 'Hindi'],
            ['order' => 4]
        );

        FooterLanguage::firstOrCreate(
            ['footer_setting_id' => $footerSetting->id, 'language' => 'Hinglish'],
            ['order' => 5]
        );

        // Create Scholars
        $imamBukhari = Scholar::firstOrCreate(
            ['slug' => 'imam-bukhari'],
            [
            'name' => 'Imam Muhammad ibn Ismail al-Bukhari',
            'biography' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Abu Abdullah Muhammad ibn Ismail al-Bukhari (810-870 CE) was a Persian Islamic scholar who compiled the hadith collection known as Sahih al-Bukhari, regarded by Sunni Muslims as one of the most authentic (sahih) hadith collections. He spent sixteen years compiling the work, and ended up with 2,602 hadiths (9,082 with repetition).',
                            ],
                        ],
                    ],
                ],
            ],
            'era' => '3rd century AH (9th century CE)',
            ]
        );

        $imamMuslim = Scholar::firstOrCreate(
            ['slug' => 'imam-muslim'],
            [
            'name' => 'Imam Muslim ibn al-Hajjaj',
            'biography' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Abu al-Husayn Muslim ibn al-Hajjaj al-Qushayri al-Naysaburi (815-875 CE) was a Persian Islamic scholar, particularly known as a muhaddith (scholar of hadith). His hadith collection, known as Sahih Muslim, is one of the six major hadith collections in Sunni Islam and is considered the second most authentic hadith collection after Sahih al-Bukhari.',
                            ],
                        ],
                    ],
                ],
            ],
            'era' => '3rd century AH (9th century CE)',
            ]
        );

        $imamAbuDawud = Scholar::firstOrCreate(
            ['slug' => 'imam-abu-dawud'],
            [
            'name' => 'Imam Abu Dawud',
            'biography' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Abu Dawud Sulayman ibn al-Ash\'ath al-Azdi as-Sijistani (817-889 CE) was a Persian scholar of prophetic hadith who compiled the third of the six "canonical" hadith collections recognized by Sunni Muslims, the Sunan Abu Dawud.',
                            ],
                        ],
                    ],
                ],
            ],
            'era' => '3rd century AH (9th century CE)',
            ]
        );

        // Create Collections
        $sahihBukhari = Collection::firstOrCreate(
            ['slug' => 'sahih-al-bukhari'],
            [
            'title' => 'Sahih al-Bukhari',
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Sahih al-Bukhari is a collection of hadith compiled by Imam Muhammad al-Bukhari. It is considered by Sunni Muslims to be one of the most authentic (sahih) hadith collections, along with Sahih Muslim.',
                            ],
                        ],
                    ],
                ],
            ],
            'scholar_id' => $imamBukhari->id,
            'publication_info' => 'Compiled in the 3rd century AH (9th century CE)',
            ]
        );

        $sahihMuslim = Collection::firstOrCreate(
            ['slug' => 'sahih-muslim'],
            [
            'title' => 'Sahih Muslim',
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Sahih Muslim is a collection of hadith compiled by Imam Muslim ibn al-Hajjaj. It is considered to be one of the most authentic hadith collections, second only to Sahih al-Bukhari.',
                            ],
                        ],
                    ],
                ],
            ],
            'scholar_id' => $imamMuslim->id,
            'publication_info' => 'Compiled in the 3rd century AH (9th century CE)',
            ]
        );

        $sunanAbuDawud = Collection::firstOrCreate(
            ['slug' => 'sunan-abu-dawud'],
            [
            'title' => 'Sunan Abu Dawud',
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Sunan Abu Dawud is a collection of hadith compiled by Imam Abu Dawud. It is one of the six canonical hadith collections (Kutub al-Sittah) of Sunni Islam.',
                            ],
                        ],
                    ],
                ],
            ],
            'scholar_id' => $imamAbuDawud->id,
            'publication_info' => 'Compiled in the 3rd century AH (9th century CE)',
            ]
        );

        // Add tags to collections
        CollectionTag::firstOrCreate(['collection_id' => $sahihBukhari->id, 'tag' => 'Sahih']);
        CollectionTag::firstOrCreate(['collection_id' => $sahihBukhari->id, 'tag' => 'Authentic']);
        CollectionTag::firstOrCreate(['collection_id' => $sahihBukhari->id, 'tag' => 'Six Books']);

        CollectionTag::firstOrCreate(['collection_id' => $sahihMuslim->id, 'tag' => 'Sahih']);
        CollectionTag::firstOrCreate(['collection_id' => $sahihMuslim->id, 'tag' => 'Authentic']);
        CollectionTag::firstOrCreate(['collection_id' => $sahihMuslim->id, 'tag' => 'Six Books']);

        CollectionTag::firstOrCreate(['collection_id' => $sunanAbuDawud->id, 'tag' => 'Sunan']);
        CollectionTag::firstOrCreate(['collection_id' => $sunanAbuDawud->id, 'tag' => 'Six Books']);

        // Create Books for Sahih al-Bukhari
        $book1 = Book::firstOrCreate(
            ['slug' => 'book-of-revelation', 'collection_id' => $sahihBukhari->id],
            [
            'title' => 'The Book of Revelation',
            'collection_id' => $sahihBukhari->id,
            'book_number' => 1,
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'This book contains hadiths about the beginning of revelation and how the Quran was revealed to the Prophet Muhammad (peace be upon him).',
                            ],
                        ],
                    ],
                ],
            ],
            ]
        );

        $book2 = Book::firstOrCreate(
            ['slug' => 'book-of-faith', 'collection_id' => $sahihBukhari->id],
            [
            'title' => 'The Book of Faith',
            'collection_id' => $sahihBukhari->id,
            'book_number' => 2,
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'This book contains hadiths about faith (Iman), its pillars, and what constitutes faith in Islam.',
                            ],
                        ],
                    ],
                ],
            ],
            ]
        );

        $book3 = Book::firstOrCreate(
            ['slug' => 'book-of-knowledge', 'collection_id' => $sahihBukhari->id],
            [
            'title' => 'The Book of Knowledge',
            'collection_id' => $sahihBukhari->id,
            'book_number' => 3,
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'This book contains hadiths about the importance of seeking knowledge and the virtues of scholars.',
                            ],
                        ],
                    ],
                ],
            ],
            ]
        );

        // Create Books for Sahih Muslim
        $book4 = Book::firstOrCreate(
            ['slug' => 'book-of-faith-muslim', 'collection_id' => $sahihMuslim->id],
            [
            'title' => 'The Book of Faith',
            'collection_id' => $sahihMuslim->id,
            'book_number' => 1,
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'This book contains hadiths about faith and its fundamentals.',
                            ],
                        ],
                    ],
                ],
            ],
            ]
        );

        // Create Chapters
        $chapter1 = Chapter::firstOrCreate(
            ['slug' => 'how-revelation-started', 'book_id' => $book1->id],
            [
            'title' => 'How the Revelation Started',
            'book_id' => $book1->id,
            'chapter_number' => 1,
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'This chapter discusses how the revelation began for the Prophet Muhammad (peace be upon him).',
                            ],
                        ],
                    ],
                ],
            ],
            ]
        );

        $chapter2 = Chapter::firstOrCreate(
            ['slug' => 'first-revelation', 'book_id' => $book1->id],
            [
            'title' => 'The First Revelation',
            'book_id' => $book1->id,
            'chapter_number' => 2,
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'This chapter contains hadiths about the first revelation received by the Prophet.',
                            ],
                        ],
                    ],
                ],
            ],
            ]
        );

        $chapter3 = Chapter::firstOrCreate(
            ['slug' => 'what-is-faith', 'book_id' => $book2->id],
            [
            'title' => 'What is Faith?',
            'book_id' => $book2->id,
            'chapter_number' => 1,
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'This chapter explains the meaning and components of faith in Islam.',
                            ],
                        ],
                    ],
                ],
            ],
            ]
        );

        $chapter4 = Chapter::firstOrCreate(
            ['slug' => 'pillars-of-islam', 'book_id' => $book2->id],
            [
            'title' => 'The Pillars of Islam',
            'book_id' => $book2->id,
            'chapter_number' => 2,
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'This chapter discusses the five pillars of Islam.',
                            ],
                        ],
                    ],
                ],
            ],
            ]
        );

        $chapter5 = Chapter::firstOrCreate(
            ['slug' => 'seeking-knowledge-obligatory', 'book_id' => $book3->id],
            [
            'title' => 'Seeking Knowledge is Obligatory',
            'book_id' => $book3->id,
            'chapter_number' => 1,
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'This chapter emphasizes the importance of seeking knowledge in Islam.',
                            ],
                        ],
                    ],
                ],
            ],
            ]
        );

        // Create Topics
        $topics = [
            Topic::firstOrCreate(
                ['slug' => 'faith-and-belief'],
                [
                'title' => 'Faith and Belief',
                'description' => 'Hadiths related to faith, belief, and the fundamentals of Islam',
                ]
            ),
            Topic::firstOrCreate(
                ['slug' => 'prayer'],
                [
                'title' => 'Prayer',
                'description' => 'Hadiths about Salah (prayer) and its importance',
                ]
            ),
            Topic::firstOrCreate(
                ['slug' => 'knowledge'],
                [
                'title' => 'Knowledge',
                'description' => 'Hadiths about seeking knowledge and the virtues of learning',
                ]
            ),
            Topic::firstOrCreate(
                ['slug' => 'revelation'],
                [
                'title' => 'Revelation',
                'description' => 'Hadiths about the revelation of the Quran',
                ]
            ),
            Topic::firstOrCreate(
                ['slug' => 'character-and-morals'],
                [
                'title' => 'Character and Morals',
                'description' => 'Hadiths about good character and Islamic ethics',
                ]
            ),
            Topic::firstOrCreate(
                ['slug' => 'charity'],
                [
                'title' => 'Charity',
                'description' => 'Hadiths about Zakat and charity in Islam',
                ]
            ),
            Topic::firstOrCreate(
                ['slug' => 'fasting'],
                [
                'title' => 'Fasting',
                'description' => 'Hadiths about Ramadan and fasting',
                ]
            ),
            Topic::firstOrCreate(
                ['slug' => 'pilgrimage'],
                [
                'title' => 'Pilgrimage',
                'description' => 'Hadiths about Hajj and Umrah',
                ]
            ),
        ];

        // Create Hadiths
        $hadith1 = Hadith::firstOrCreate(
            [
                'collection_id' => $sahihBukhari->id,
                'book_id' => $book1->id,
                'chapter_id' => $chapter1->id,
                'reference_number' => '1',
            ],
            [
            'text_arabic' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حدثنا الحميدي عبد الله بن الزبير قال حدثنا سفيان قال حدثنا يحيى بن سعيد الأنصاري قال أخبرني محمد بن إبراهيم التيمي أنه سمع علقمة بن وقاص الليثي يقول سمعت عمر بن الخطاب رضي الله عنه على المنبر قال سمعت رسول الله صلى الله عليه وسلم يقول إنما الأعمال بالنيات وإنما لكل امرئ ما نوى فمن كانت هجرته إلى دنيا يصيبها أو إلى امرأة ينكحها فهجرته إلى ما هاجر إليه',
                            ],
                        ],
                    ],
                ],
            ],
            'text_english' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Narrated \'Umar bin Al-Khattab: I heard Allah\'s Messenger (ﷺ) saying, "The reward of deeds depends upon the intentions and every person will get the reward according to what he has intended. So whoever emigrated for worldly benefits or for a woman to marry, his emigration was for what he emigrated for."',
                            ],
                        ],
                    ],
                ],
            ],
            'text_urdu' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حضرت عمر بن خطاب رضی اللہ عنہ سے روایت ہے کہ میں نے رسول اللہ صلی اللہ علیہ وسلم کو فرماتے ہوئے سنا کہ اعمال کا دارومدار نیتوں پر ہے اور ہر شخص کو وہی ملے گا جس کی اس نے نیت کی۔ پس جس کی ہجرت دنیا حاصل کرنے یا کسی عورت سے شادی کرنے کے لیے ہو تو اس کی ہجرت اسی کے لیے ہوگی جس کے لیے اس نے ہجرت کی۔',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hindi' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'हज़रत उमर बिन अल-खत्ताब से रिवायत है कि मैंने अल्लाह के रसूल (सल्लल्लाहु अलैहि व सल्लम) को कहते हुए सुना कि "कर्मों का फल नियत पर निर्भर करता है और हर व्यक्ति को वही मिलेगा जिसकी उसने नियत की। तो जिसकी हिजरत दुनिया हासिल करने या किसी औरत से शादी करने के लिए हो, तो उसकी हिजरत उसी के लिए होगी जिसके लिए उसने हिजरत की।"',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hinglish' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Hazrat Umar bin Al-Khattab se riwayat hai ki maine Allah ke Rasool (Sallallahu Alaihi Wasallam) ko kehte hue suna ki "kaam ka phal niyat par depend karta hai aur har shaks ko wahi milega jiski usne niyat ki. Toh jiski hijrat duniya hasil karne ya kisi aurat se shaadi karne ke liye ho, toh uski hijrat usi ke liye hogi jiske liye usne hijrat ki."',
                            ],
                        ],
                    ],
                ],
            ],
            'grade' => 'Sahih',
            ]
        );

        $hadith1->topics()->syncWithoutDetaching([$topics[0]->id, $topics[4]->id]);

        HadithNarrator::firstOrCreate([
            'hadith_id' => $hadith1->id,
            'narrator' => 'Umar bin Al-Khattab',
        ]);

        $hadith2 = Hadith::firstOrCreate(
            [
                'collection_id' => $sahihBukhari->id,
                'book_id' => $book1->id,
                'chapter_id' => $chapter2->id,
                'reference_number' => '3',
            ],
            [
            'text_arabic' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حدثنا يحيى بن بكير قال حدثنا الليث عن عقيل عن ابن شهاب عن عروة بن الزبير عن عائشة أم المؤمنين أنها قالت أول ما بدئ به رسول الله صلى الله عليه وسلم من الوحي الرؤيا الصالحة في النوم فكان لا يرى رؤيا إلا جاءت مثل فلق الصبح ثم حبب إليه الخلاء وكان يخلو بغار حراء فيتحنث فيه وهو التعبد الليالي ذوات العدد قبل أن ينزع إلى أهله ويتزود لذلك ثم يرجع إلى خديجة فيتزود لمثلها حتى جاءه الحق وهو في غار حراء',
                            ],
                        ],
                    ],
                ],
            ],
            'text_english' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Narrated \'Aisha: (the mother of the faithful believers) The commencement of the Divine Inspiration to Allah\'s Messenger (ﷺ) was in the form of good dreams which came true like bright daylight, and then the love of seclusion was bestowed upon him. He used to go in seclusion in the cave of Hira where he used to worship (Allah alone) continuously for many days before his desire to see his family. He used to take with him the journey food for the stay and then come back to (his wife) Khadija to take his food likewise again till suddenly the Truth descended upon him while he was in the cave of Hira.',
                            ],
                        ],
                    ],
                ],
            ],
            'text_urdu' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حضرت عائشہ رضی اللہ عنہا سے روایت ہے کہ رسول اللہ صلی اللہ علیہ وسلم پر وحی کا آغاز نیک خوابوں کی صورت میں ہوا جو صبح کی روشنی کی طرح سچے ثابت ہوتے تھے۔ پھر آپ کو خلوت پسند آئی اور آپ غار حرا میں خلوت اختیار کرتے تھے جہاں آپ کئی راتیں عبادت کرتے تھے، پھر اپنے گھر واپس آتے تھے۔',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hindi' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'हज़रत आयशा (रज़ी अल्लाहु अन्हा) से रिवायत है कि अल्लाह के रसूल (सल्लल्लाहु अलैहि व सल्लम) पर वही का आरंभ अच्छे सपनों के रूप में हुआ जो सुबह की रोशनी की तरह सच साबित होते थे। फिर आपको एकांत पसंद आया और आप गुफा हिरा में एकांत में जाते थे जहाँ आप कई रातें इबादत करते थे।',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hinglish' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Hazrat Aisha (Radiyallahu Anha) se riwayat hai ki Allah ke Rasool (Sallallahu Alaihi Wasallam) par wahi ka aarambh acche sapno ke roop mein hua jo subah ki roshni ki tarah sach sabit hote the. Phir aapko ekant pasand aaya aur aap gufa Hira mein ekant mein jate the jahan aap kai raaten ibadat karte the.',
                            ],
                        ],
                    ],
                ],
            ],
            'grade' => 'Sahih',
            ]
        );

        $hadith2->topics()->syncWithoutDetaching([$topics[3]->id]);

        HadithNarrator::firstOrCreate([
            'hadith_id' => $hadith2->id,
            'narrator' => 'Aisha bint Abi Bakr',
        ]);

        $hadith3 = Hadith::firstOrCreate(
            [
                'collection_id' => $sahihBukhari->id,
                'book_id' => $book2->id,
                'chapter_id' => $chapter3->id,
                'reference_number' => '13',
            ],
            [
            'text_arabic' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حدثنا مسدد قال حدثنا يحيى عن شعبة عن قتادة عن أنس رضي الله عنه عن النبي صلى الله عليه وسلم وعن حسين المعلم قال حدثنا قتادة عن أنس عن النبي صلى الله عليه وسلم قال لا يؤمن أحدكم حتى أكون أحب إليه من والده وولده والناس أجمعين',
                            ],
                        ],
                    ],
                ],
            ],
            'text_english' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Narrated Anas: The Prophet (ﷺ) said, "None of you will have faith till he wishes for his (Muslim) brother what he likes for himself."',
                            ],
                        ],
                    ],
                ],
            ],
            'text_urdu' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حضرت انس رضی اللہ عنہ سے روایت ہے کہ نبی صلی اللہ علیہ وسلم نے فرمایا: "تم میں سے کوئی شخص مومن نہیں ہو سکتا جب تک کہ وہ اپنے بھائی کے لیے وہی پسند نہ کرے جو وہ اپنے لیے پسند کرتا ہے۔"',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hindi' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'हज़रत अनस से रिवायत है कि नबी (सल्लल्लाहु अलैहि व सल्लम) ने फरमाया: "तुम में से कोई व्यक्ति मोमिन नहीं हो सकता जब तक कि वह अपने भाई के लिए वही पसंद न करे जो वह अपने लिए पसंद करता है।"',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hinglish' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Hazrat Anas se riwayat hai ki Nabi (Sallallahu Alaihi Wasallam) ne farmaya: "Tum mein se koi shaks momin nahi ho sakta jab tak ki woh apne bhai ke liye wahi pasand na kare jo woh apne liye pasand karta hai."',
                            ],
                        ],
                    ],
                ],
            ],
            'grade' => 'Sahih',
            ]
        );

        $hadith3->topics()->syncWithoutDetaching([$topics[0]->id, $topics[4]->id]);

        HadithNarrator::firstOrCreate([
            'hadith_id' => $hadith3->id,
            'narrator' => 'Anas bin Malik',
        ]);

        $hadith4 = Hadith::firstOrCreate(
            [
                'collection_id' => $sahihBukhari->id,
                'book_id' => $book2->id,
                'chapter_id' => $chapter4->id,
                'reference_number' => '8',
            ],
            [
            'text_arabic' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حدثنا عبد الله بن مسلمة قال حدثنا مالك عن ابن شهاب عن محمد بن جبير بن مطعم عن أبيه قال سمعت رسول الله صلى الله عليه وسلم يقرأ في المغرب بالطور',
                            ],
                        ],
                    ],
                ],
            ],
            'text_english' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Narrated Ibn \'Umar: Allah\'s Messenger (ﷺ) said: Islam is based on (the following) five (principles): 1. To testify that none has the right to be worshipped but Allah and Muhammad is Allah\'s Messenger (ﷺ). 2. To offer the (compulsory congregational) prayers dutifully and perfectly. 3. To pay Zakat (i.e. obligatory charity). 4. To perform Hajj (i.e. Pilgrimage to Mecca). 5. To observe fast during the month of Ramadan.',
                            ],
                        ],
                    ],
                ],
            ],
            'text_urdu' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حضرت ابن عمر رضی اللہ عنہما سے روایت ہے کہ رسول اللہ صلی اللہ علیہ وسلم نے فرمایا: "اسلام پانچ چیزوں پر قائم ہے: گواہی دینا کہ اللہ کے سوا کوئی معبود نہیں اور محمد صلی اللہ علیہ وسلم اللہ کے رسول ہیں، نماز قائم کرنا، زکوٰۃ ادا کرنا، حج کرنا، اور رمضان کے روزے رکھنا۔"',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hindi' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'हज़रत इब्न उमर से रिवायत है कि अल्लाह के रसूल (सल्लल्लाहु अलैहि व सल्लम) ने फरमाया: "इस्लाम पाँच चीज़ों पर क़ायम है: गवाही देना कि अल्लाह के सिवा कोई माबूद नहीं और मुहम्मद (सल्लल्लाहु अलैहि व सल्लम) अल्लाह के रसूल हैं, नमाज़ क़ायम करना, ज़कात अदा करना, हज करना, और रमज़ान के रोज़े रखना।"',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hinglish' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Hazrat Ibn Umar se riwayat hai ki Allah ke Rasool (Sallallahu Alaihi Wasallam) ne farmaya: "Islam paanch cheezo par qayam hai: gawahi dena ki Allah ke siwa koi mabud nahi aur Muhammad (Sallallahu Alaihi Wasallam) Allah ke Rasool hain, namaz qayam karna, zakat ada karna, haj karna, aur Ramzan ke roze rakhna."',
                            ],
                        ],
                    ],
                ],
            ],
            'grade' => 'Sahih',
            ]
        );

        $hadith4->topics()->syncWithoutDetaching([$topics[0]->id, $topics[1]->id, $topics[5]->id, $topics[6]->id, $topics[7]->id]);

        HadithNarrator::firstOrCreate([
            'hadith_id' => $hadith4->id,
            'narrator' => 'Ibn Umar',
        ]);

        $hadith5 = Hadith::firstOrCreate(
            [
                'collection_id' => $sahihBukhari->id,
                'book_id' => $book3->id,
                'chapter_id' => $chapter5->id,
                'reference_number' => '71',
            ],
            [
            'text_arabic' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حدثنا قتيبة بن سعيد حدثنا ليث عن سعيد بن أبي سعيد عن أبيه عن أبي هريرة أن رسول الله صلى الله عليه وسلم قال من سلك طريقا يلتمس فيه علما سهل الله له به طريقا إلى الجنة',
                            ],
                        ],
                    ],
                ],
            ],
            'text_english' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Narrated Abu Huraira: Allah\'s Messenger (ﷺ) said, "Whoever travels a path in search of knowledge, Allah will make easy for him a path to Paradise."',
                            ],
                        ],
                    ],
                ],
            ],
            'text_urdu' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'حضرت ابو ہریرہ رضی اللہ عنہ سے روایت ہے کہ رسول اللہ صلی اللہ علیہ وسلم نے فرمایا: "جس نے علم حاصل کرنے کے لیے کوئی راستہ اختیار کیا، اللہ تعالیٰ اس کے لیے جنت کا راستہ آسان کر دے گا۔"',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hindi' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'हज़रत अबू हुरैरा से रिवायत है कि अल्लाह के रसूल (सल्लल्लाहु अलैहि व सल्लम) ने फरमाया: "जिसने इल्म हासिल करने के लिए कोई रास्ता इख्तियार किया, अल्लाह तआला उसके लिए जन्नत का रास्ता आसान कर देगा।"',
                            ],
                        ],
                    ],
                ],
            ],
            'text_hinglish' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Hazrat Abu Huraira se riwayat hai ki Allah ke Rasool (Sallallahu Alaihi Wasallam) ne farmaya: "Jisne ilm hasil karne ke liye koi rasta ikhtiyar kiya, Allah Ta\'ala uske liye jannat ka rasta aasan kar dega."',
                            ],
                        ],
                    ],
                ],
            ],
            'grade' => 'Sahih',
            ]
        );

        $hadith5->topics()->syncWithoutDetaching([$topics[2]->id]);

        HadithNarrator::firstOrCreate([
            'hadith_id' => $hadith5->id,
            'narrator' => 'Abu Huraira',
        ]);

        // Create pages
        Page::firstOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About',
                'content' => [
                    'type' => 'doc',
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => 'Mehere Hussain is a comprehensive Islamic reference website providing access to authentic hadith collections from renowned scholars.',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        Page::firstOrCreate(
            ['slug' => 'privacy'],
            [
                'title' => 'Privacy Policy',
                'content' => [
                    'type' => 'doc',
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => 'This privacy policy explains how we collect, use, and protect your personal information.',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        // Seed super admin user
        $this->call(SuperAdminSeeder::class);
    }
}
