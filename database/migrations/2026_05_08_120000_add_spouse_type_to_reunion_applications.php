<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Only add the column if it doesn't exist yet
        if (!Schema::hasColumn('reunion_applications', 'spouse_type')) {
            Schema::table('reunion_applications', function (Blueprint $table) {
                $table->string('spouse_type')->nullable()->after('gender');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('reunion_applications', 'spouse_type')) {
            Schema::table('reunion_applications', function (Blueprint $table) {
                $table->dropColumn('spouse_type');
            });
        }
    }
};
