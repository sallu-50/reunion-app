<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        // reunion_applications: ensure email is nullable and remove unique index
        if (Schema::hasTable('reunion_applications')) {
            if ($driver === 'sqlite') {
                // build temp table with email nullable (and no unique constraint)
                if (Schema::hasTable('reunion_applications_temp')) {
                    Schema::dropIfExists('reunion_applications_temp');
                }

                DB::statement(<<<'SQL'
CREATE TABLE reunion_applications_temp (
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT,
    phone TEXT,
    graduation_year INTEGER,
    message TEXT,
    status TEXT DEFAULT 'pending',
    created_at DATETIME,
    updated_at DATETIME,
    gender TEXT,
    spouse_type TEXT,
    member_type TEXT,
    tshirt_size TEXT,
    number_of_children INTEGER DEFAULT 0,
    payment_method TEXT,
    donation_amount INTEGER DEFAULT 0,
    transaction_number TEXT
);
SQL
                );

                // copy data
                DB::statement('INSERT INTO reunion_applications_temp (id, name, email, phone, graduation_year, message, status, created_at, updated_at, gender, spouse_type, member_type, tshirt_size, number_of_children, payment_method, donation_amount, transaction_number) SELECT id, name, email, phone, graduation_year, message, status, created_at, updated_at, gender, spouse_type, member_type, tshirt_size, number_of_children, payment_method, donation_amount, transaction_number FROM reunion_applications');

                Schema::drop('reunion_applications');
                Schema::rename('reunion_applications_temp', 'reunion_applications');
            } else {
                Schema::table('reunion_applications', function (Blueprint $table) {
                    $table->string('email')->nullable()->change();
                    // drop unique index if exists
                    try {
                        $table->dropUnique(['email']);
                    } catch (\Throwable $_) {
                        // ignore if doesn't exist
                    }
                });
            }
        }

        // users table: make email nullable and remove unique constraint
        if (Schema::hasTable('users')) {
            if ($driver === 'sqlite') {
                if (Schema::hasTable('users_temp')) {
                    Schema::dropIfExists('users_temp');
                }

                DB::statement(<<<'SQL'
CREATE TABLE users_temp (
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT,
    email_verified_at DATETIME,
    password TEXT NOT NULL,
    remember_token TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    role TEXT DEFAULT 'viewer',
    phone TEXT,
    is_approved INTEGER DEFAULT 0
);
SQL
                );

                DB::statement('INSERT INTO users_temp (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role, phone, is_approved) SELECT id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role, phone, is_approved FROM users');

                Schema::drop('users');
                Schema::rename('users_temp', 'users');
            } else {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('email')->nullable()->change();
                    try {
                        $table->dropUnique(['email']);
                    } catch (\Throwable $_) {
                    }
                });
            }
        }

        // password_reset_tokens: recreate as id PK and nullable email
        if (Schema::hasTable('password_reset_tokens')) {
            if ($driver === 'sqlite') {
                if (Schema::hasTable('password_reset_tokens_new')) {
                    Schema::dropIfExists('password_reset_tokens_new');
                }

                DB::statement(<<<'SQL'
CREATE TABLE password_reset_tokens_new (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT,
    token TEXT NOT NULL,
    created_at DATETIME
);
SQL
                );

                DB::statement('INSERT INTO password_reset_tokens_new (email, token, created_at) SELECT email, token, created_at FROM password_reset_tokens');

                Schema::drop('password_reset_tokens');
                Schema::rename('password_reset_tokens_new', 'password_reset_tokens');
            } else {
                // non-sqlite: alter table to make email nullable; may require doctrine/dbal
                Schema::table('password_reset_tokens', function (Blueprint $table) {
                    // if email is primary key this may fail; safer to leave manual for non-sqlite environments
                    try {
                        $table->string('email')->nullable()->change();
                    } catch (\Throwable $_) {
                        // ignore - advise manual fix
                    }
                });
            }
        }
    }

    public function down(): void
    {
        // No-op: reversing these destructive SQLite operations is non-trivial and not required here.
    }
};
