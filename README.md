# App Management School (Laravel + Filament)

A school management application built with Laravel, Filament v3/v4 style widgets, and Vite.

## Requirements
- PHP >= 8.2
- Composer
- Node.js 18+
- SQLite/MySQL (project includes SQLite for local dev)

## Quick start
```bash
# 1) Install PHP deps
composer install

# 2) Copy environment and generate key
cp .env.example .env
php artisan key:generate

# 3) Configure database in .env (SQLite or MySQL)
# For SQLite example:
# DB_CONNECTION=sqlite
# touch database/database.sqlite

# 4) Run migrations and seeders (optional)
php artisan migrate --seed

# 5) Install JS deps & build assets
npm install
npm run dev   # or: npm run build

# 6) Serve
php artisan serve
```

## Default credentials
If you seeded users, check `database/seeders` for created accounts. Otherwise, register/login according to your auth setup.

## Development tips
- Filament assets are handled by Vite (see `vite.config.js`).
- Custom widgets live under `app/Filament/Widgets` and views under `resources/views/filament/widgets`.
- Avoid committing `.env`, `vendor/`, `node_modules/`, and DB files (see `.gitignore`).

## License
MIT — see `LICENSE` for details.
