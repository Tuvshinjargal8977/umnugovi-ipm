# Өмнөговь аймгийн Төслийн нэгдсэн удирдлагын газар — вэбсайт

Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэх төслүүдийн мэдээллийн
сайт. Танилцуулга, төслийн нэгдсэн сан, мэдээ мэдээлэл, ил тод байдал, холбоо барих.

## Технологи

| Давхарга | |
|---|---|
| Backend | Laravel 12 (PHP 8.4) |
| Frontend | Inertia.js + React 19 + TypeScript |
| Загвар | Tailwind CSS v4 |
| Админ (CMS) | Filament 3 |
| Олон хэл | `spatie/laravel-translatable` (MN / EN) |
| Өгөгдлийн сан | SQLite (dev) / PostgreSQL, MySQL (prod) |

## Локал орчинд ажиллуулах

Шаардлага: PHP 8.4+, Composer, Node.js 20+ (эсвэл [Laravel Herd](https://herd.laravel.com)).

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

# SQLite
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link

# Админ хэрэглэгч
php artisan make:filament-user

# Хөгжүүлэлт
npm run dev          # Vite
php artisan serve    # эсвэл Herd-ээр pppc.test
```

- Нүүр: `http://127.0.0.1:8000`
- Админ: `http://127.0.0.1:8000/admin`

## Бүтэц

```
app/
  Http/Controllers/       Home, Project, Post, Page, Search, Contact
  Http/Middleware/         HandleInertiaRequests (nav, site info), SetLocale
  Models/                  Project, ProjectCategory, Post, PostCategory, Page, ContactMessage
  Filament/Resources/      админы CRUD
database/seeders/          UmnugoviProjectSeeder (20 төсөл), PageSeeder, DemoContentSeeder
resources/
  js/Pages/                Home, Projects/*, Posts/*, Pages/Show, Contact, Search, Error
  js/Components/           Header, Footer, ProjectCard, PageHero, ...
  js/lib/catVisual.ts      салбарын өнгө/дүрс
  css/app.css              Tailwind theme (@theme)
routes/web.php
```

## Тест

```bash
php artisan test
```

## Production deploy (товч)

```bash
composer install --no-dev --optimize-autoloader
npm run build
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

`.env`: `APP_ENV=production`, `APP_DEBUG=false`, бодит `DB_*`, `APP_URL`.
