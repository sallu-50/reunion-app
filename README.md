<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Database CSV dump command

This project includes an Artisan command to export the SQLite database tables to CSV files.

- Command: `php artisan db:dump-csv`
- Options:
    - `--path=` Directory under `storage/app` to write files to (default: `db-dumps`). Note: this app's local disk uses `storage/app/private` as its root, so the final path will usually be `storage/app/private/{path}`.
    - `--table=` Optional single table name to export just that table.

Example:

php artisan db:dump-csv --path=my-dump

This writes CSV files for each table into `storage/app/private/my-dump` by default.

## Registration + Admin approval + SMS

This project supports a flow where users register with a phone number and an admin approves them. On approval an SMS is sent using the Larament/Barta package.

Environment variables:

- `BARTA_DRIVER` - which SMS driver to use (e.g. `log`, `mimsms`, or other drivers supported by Larament/Barta). Configure driver-specific keys as documented by Larament/Barta.

How it works:

1. Users register via the standard register form (now includes `phone`). Users are created with `is_approved=false`.
2. A super admin approves a user via the admin UI. That action sets `is_approved=true` and dispatches a background job to send an SMS.
3. The SMS job uses the Larament/Barta facade to send the message (see `app/Jobs/SendApprovalSms.php`).

Quick test:

1. Configure `BARTA_DRIVER` and driver-specific env keys in `.env` according to the Larament/Barta docs: https://barta.larament.com/
2. Run migrations:

php artisan migrate

3. Seed admin users if needed:

php artisan db:seed --class=AdminUserSeeder

4. Register a new user (include phone), login as superadmin, approve the user and inspect logs/queue to ensure SMS is queued/sent.
