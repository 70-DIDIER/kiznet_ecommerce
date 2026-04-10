# Kiznet Ecommerce

A Laravel 12 e-commerce application built with modern web technologies.

## Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Tailwind CSS 4, Vite
- **API:** Laravel Sanctum 4
- **Authorization:** Spatie Laravel Permission
- **Testing:** PHPUnit
- **Code Style:** Laravel Pint

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite, MySQL, PostgreSQL, or your preferred database

## Installation

### Clone the repository

```bash
git clone <repository-url>
cd kiznet_ecommerce
```

### Install dependencies

```bash
composer install
npm install
```

### Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database in the `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kiznet_ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

### Database migration

```bash
php artisan migrate
```

### Build assets

```bash
npm run build
```

## Development

### Start development servers

Run the application with concurrent server, queue, and Vite processes:

```bash
composer run dev
```

Or run individually:

```bash
php artisan serve
npm run dev
```

### Running tests

```bash
composer run test
```

Run a specific test file:

```bash
php artisan test --compact tests/Feature/ExampleTest.php
```

## Code Formatting

This project uses Laravel Pint for code formatting. Run before committing:

```bash
vendor/bin/pint --format agent
```

## Project Structure

```
├── app/
│   ├── Http/           # Controllers, Middleware, Requests
│   ├── Models/         # Eloquent models
│   ├── Services/       # Business logic services
│   └── Mail/           # Mailable classes
├── database/
│   ├── migrations/     # Database migrations
│   ├── seeders/        # Database seeders
│   └── factories/      # Model factories
├── routes/
│   ├── web.php         # Web routes
│   └── api.php         # API routes
├── resources/          # Views, JS, CSS
├── tests/              # PHPUnit tests
└── config/             # Configuration files
```

## Available Commands

| Command | Description |
|---------|-------------|
| `composer run setup` | Full project setup (install, migrate, build) |
| `composer run dev` | Start development servers |
| `composer run test` | Run all tests |
| `php artisan serve` | Start PHP server |
| `npm run dev` | Start Vite dev server |
| `npm run build` | Build production assets |

## License

This project is open-source and available under the [MIT License](LICENSE).
