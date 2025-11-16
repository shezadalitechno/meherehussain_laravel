# Mehere Hussain - Islamic Reference Website

A comprehensive Islamic reference website built with Laravel 12, Filament 4.0, and DaisyUI. This project provides access to authentic hadith collections with advanced search, multi-language support, and a modern UI.

## Features

- 📚 **10 Collections**: Scholars, Collections, Books, Chapters, Hadith, Topics, Pages, ContactRequests, Users, Media
- 🔍 **Advanced Search**: Query parsing with quotes, wildcards, boolean operators, and result previews
- 🌍 **Multi-language Support**: Arabic, English, Hinglish, Urdu, and Hindi translations for hadith
- 🎨 **Modern UI**: DaisyUI components with Tailwind CSS v4, dark mode support, responsive design
- 📱 **Mobile-First**: Fully responsive layout optimized for mobile reading
- 🔐 **Admin Panel**: Full-featured Filament 4.0 admin interface
- ⚡ **Performance**: Optimized queries with eager loading
- 🔎 **SEO Optimized**: Sitemap, robots.txt, structured data (JSON-LD), Open Graph tags
- 🎭 **Rich Text Editing**: TipTap editor for content management
- 📊 **Global Settings**: Header and Footer configuration via Filament Settings pages

## Tech Stack

### Core Technologies
- **Framework**: Laravel 12
- **Admin Panel**: Filament 4.0
- **Database**: SQLite (default), PostgreSQL, MySQL supported
- **Language**: PHP 8.2+
- **Package Manager**: Composer

### Frontend
- **Styling**: Tailwind CSS v4 with DaisyUI v5.5.5
- **Theme**: Dark mode support with theme toggle
- **Fonts**: Noto Sans Arabic, Noto Nastaliq Urdu
- **Build Tool**: Vite

### Development Tools
- **Search**: Custom SearchService with query parsing
- **Testing**: PHPUnit
- **Linting**: Laravel Pint

## Prerequisites

- PHP ^8.2
- Composer
- Node.js and pnpm/npm
- SQLite (default) or PostgreSQL/MySQL

## Getting Started

### 1. Install Dependencies

```bash
composer install
pnpm install
```

### 2. Environment Variables

Create a `.env` file in the root directory:

```env
APP_NAME="Mehere Hussain"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Generate application key:
```bash
php artisan key:generate
```

### 3. Run Migrations

```bash
php artisan migrate
```

### 4. Seed Database (Optional)

```bash
php artisan db:seed
```

### 5. Create Storage Link

```bash
php artisan storage:link
```

### 6. Start Development Server

```bash
php artisan serve
pnpm run dev
```

The application will be available at:
- **Frontend**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin

### 7. Create Admin User

1. Visit http://localhost:8000/admin
2. Follow the prompts to create your first admin user
3. Log in to access the admin panel

## Project Structure

```
meherehussain/
├── app/
│   ├── Console/Commands/        # Artisan commands
│   ├── Filament/                 # Filament admin panel
│   │   ├── Resources/            # Filament resources
│   │   └── Pages/                # Custom Filament pages
│   ├── Http/Controllers/         # Controllers
│   │   └── Api/                  # API controllers
│   ├── Models/                   # Eloquent models
│   └── Services/                 # Service classes
├── database/
│   ├── factories/                # Model factories
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders
├── resources/
│   ├── views/                    # Blade templates
│   │   ├── components/           # Blade components
│   │   └── layouts/             # Layout templates
│   └── css/                      # Styles
├── routes/
│   ├── web.php                   # Web routes
│   └── api.php                   # API routes
└── config/                       # Configuration files
```

## Admin Panel

Access the admin panel at `/admin` after creating your first user.

### Admin Features

- **Collection Management**: CRUD for all collections
- **Global Settings**: Configure Header and Footer
- **Rich Text Editing**: TipTap editor for content
- **Media Management**: Upload and manage images
- **User Management**: Create and manage admin users
- **Contact Requests**: View contact form submissions (read-only)

## Importing Data

Use the import command to bulk import hadith data from JSON:

```bash
php artisan hadith:import path/to/data.json
```

### JSON Format

```json
{
  "collection": {
    "title": "Sahih al-Bukhari",
    "slug": "sahih-al-bukhari",
    "scholar": "Imam Bukhari",
    "description": "...",
    "publicationInfo": "...",
    "tags": ["Sahih", "Bukhari"]
  },
  "books": [
    {
      "title": "Book of Faith",
      "slug": "book-of-faith",
      "bookNumber": 1,
      "description": "...",
      "chapters": [
        {
          "title": "Chapter 1",
          "slug": "chapter-1",
          "chapterNumber": 1,
          "description": "...",
          "hadiths": [
            {
              "referenceNumber": "1",
              "textArabic": "...",
              "textEnglish": "...",
              "textHinglish": "...",
              "textUrdu": "...",
              "textHindi": "...",
              "grade": "Sahih",
              "narrators": ["..."],
              "topics": ["Faith", "Belief"]
            }
          ]
        }
      ]
    }
  ]
}
```

## Search Features

The search functionality provides advanced query capabilities:

### Supported Query Syntax

- **Quotes**: `"pledge allegiance"` - Exact phrase matching
- **Wildcards**: `test*` - Matches test, testing, tested, etc.
- **Boolean Operators**: 
  - `AND` - Both terms must be present
  - `OR` - Either term can be present
  - `NOT` - Term must not be present

### Example Queries

```
# Simple search
pledge allegiance

# Exact phrase
"pledge allegiance"

# Wildcard search
pray*

# Boolean logic
(pledge OR oath) AND hijrah NOT mecca
```

## API Endpoints

### Search API
- **Endpoint**: `GET /api/search?q={query}`
- **Response**: JSON with search results

### Contact API
- **Endpoint**: `POST /api/contact`
- **Body**: `{ "name": "...", "email": "...", "message": "..." }`
- **Response**: JSON success message

## Available Commands

```bash
# Import hadith data
php artisan hadith:import path/to/file.json

# Clear cache
php artisan cache:clear

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed
```

## Deployment

### Production Checklist

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Run `php artisan view:cache`
5. Ensure storage link exists: `php artisan storage:link`
6. Set up proper database (PostgreSQL/MySQL recommended)
7. Configure web server (Nginx/Apache)
8. Set up SSL certificate

## License

MIT

