# Videojocs API

A small RESTful API built with Laravel for managing a video game catalog. It exposes CRUD-style JSON endpoints to list, search, create, and delete video game entries.

## Live Demo

- **API base URL:** _added after deployment_
- **Example request:** `GET /api/videojocs`

## Tech Stack

- [Laravel 12](https://laravel.com/) (PHP 8.2+)
- [Laravel Sanctum](https://laravel.com/docs/sanctum) (installed, ready for token auth)
- SQLite for local development / PostgreSQL in production
- [Vite](https://vitejs.dev/) + Tailwind CSS for the default front-end scaffolding (not required to use the API)

## API Reference

All endpoints are prefixed with `/api` and return JSON.

| Method | Endpoint | Description |
|--------|----------|--------------|
| GET | `/api/videojocs` | List all video games |
| GET | `/api/videojocs/cerca?genere=RPG` | Search video games by genre |
| GET | `/api/videojocs/{id}` | Get a single video game by ID |
| POST | `/api/videojocs` | Create a new video game |
| DELETE | `/api/videojocs/{id}` | Delete a video game by ID |

### Video game fields

| Field | Type | Description |
|-------|------|--------------|
| `titol` | string | Title of the game |
| `genere` | string | Genre (e.g. RPG, FPS, Adventure) |
| `plataforma` | string | Platform (e.g. PC, PS5, Xbox, Switch) |
| `any_llancament` | integer | Release year |
| `preu` | decimal | Price |

### Example: create a video game

```bash
curl -X POST https://<your-demo-url>/api/videojocs \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "titol": "Shadow Dark Quest",
    "genere": "RPG",
    "plataforma": "PC",
    "any_llancament": 2023,
    "preu": 39.99
  }'
```

Response:

```json
{
  "success": true,
  "message": "Videojoc creat correctament",
  "data": {
    "id": 21,
    "titol": "Shadow Dark Quest",
    "genere": "RPG",
    "plataforma": "PC",
    "any_llancament": 2023,
    "preu": "39.99",
    "created_at": "...",
    "updated_at": "..."
  }
}
```

## Local Setup

Requirements: PHP 8.2+, Composer, Node.js (optional, only for the default asset scaffolding).

```bash
git clone <this-repo-url>
cd api-videojocs

composer install
cp .env.example .env
php artisan key:generate

# creates database/database.sqlite and runs migrations
touch database/database.sqlite
php artisan migrate

# optional: seed 20 sample video games
php artisan db:seed --class=VideojocSeeder

php artisan serve
```

The API will be available at `http://localhost:8000/api/videojocs`.

## Deployment

This project is deployed on [Railway](https://railway.com) using its automatic PHP/Laravel build (Nixpacks + php-fpm + Caddy), with a managed PostgreSQL database for persistent storage.

Key production environment variables:

| Variable | Value |
|----------|-------|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_KEY` | generated with `php artisan key:generate --show` |
| `DB_CONNECTION` | `pgsql` |
| `DB_URL` | `${{Postgres.DATABASE_URL}}` |
| `LOG_CHANNEL` | `stderr` |

Migrations run automatically on each deploy via the pre-deploy hook in [`railway/init-app.sh`](railway/init-app.sh).

## License

This project is open-sourced software. The underlying [Laravel framework](https://laravel.com) is licensed under the [MIT license](https://opensource.org/licenses/MIT).
