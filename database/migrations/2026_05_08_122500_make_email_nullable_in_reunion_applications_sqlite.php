<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();
        if ($driver !== 'sqlite') {
            // For non-sqlite, a simple change() would work (but here we only handle sqlite)
            return;
        }

        // Check if email column is NOT NULL
        $info = DB::select("PRAGMA table_info('reunion_applications')");
        $emailNotNull = false;
        foreach ($info as $col) {
            $name = is_object($col) ? $col->name : $col['name'];
            $notnull = is_object($col) ? $col->notnull : $col['notnull'];
            if ($name === 'email' && intval($notnull) === 1) {
                $emailNotNull = true;
                break;
            }
        }

        if (! $emailNotNull) {
            return;
        }

        DB::beginTransaction();
        try {
            // Build CREATE TABLE statement for new table with email nullable
            // We'll create a new table with the desired schema. Keep columns flexible.
            DB::statement(<<<'SQL'
                CREATE TABLE reunion_applications_new (
                    id INTEGER PRIMARY KEY,
                    name varchar,
                    email varchar NULL,
                    phone varchar,
                    graduation_year INTEGER,
                    message TEXT,
                    status varchar DEFAULT 'pending',
                    created_at datetime,
                    updated_at datetime,
                    gender varchar,
                    spouse_type varchar,
                    member_type varchar,
                    tshirt_size varchar,
                    number_of_children INTEGER DEFAULT 0,
                    payment_method varchar,
                    donation_amount INTEGER DEFAULT 0,
                    transaction_number varchar
                );
            SQL);

            // Copy data across (explicit column list)
            DB::statement(<<<'SQL'
                INSERT INTO reunion_applications_new (id, name, email, phone, graduation_year, message, status, created_at, updated_at, gender, spouse_type, member_type, tshirt_size, number_of_children, payment_method, donation_amount, transaction_number)
                SELECT id, name, email, phone, graduation_year, message, status, created_at, updated_at, gender, spouse_type, member_type, tshirt_size, number_of_children, payment_method, donation_amount, transaction_number FROM reunion_applications;
            SQL);

            DB::statement('DROP TABLE reunion_applications');
            DB::statement('ALTER TABLE reunion_applications_new RENAME TO reunion_applications');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function down(): void
    {
        // No-op: reversing this exactly is non-trivial.
    }
};
