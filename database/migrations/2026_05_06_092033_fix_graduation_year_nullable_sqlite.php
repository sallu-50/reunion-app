<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // নতুন table (correct schema)
        Schema::create('reunion_applications_temp', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->integer('graduation_year')->nullable(); // ✅ FIXED
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        // পুরাতন data copy
        DB::statement("
            INSERT INTO reunion_applications_temp
            (id, name, email, phone, graduation_year, message, status, created_at, updated_at)
            SELECT
            id, name, email, phone, graduation_year, message, status, created_at, updated_at
            FROM reunion_applications
        ");

        // old table delete
        Schema::drop('reunion_applications');

        // rename new table
        Schema::rename('reunion_applications_temp', 'reunion_applications');
    }

    public function down(): void
    {
        // optional rollback
    }
};