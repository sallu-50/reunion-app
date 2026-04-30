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
        Schema::table('reunion_applications', function (Blueprint $table) {
            $table->string('spouse_type')->nullable()->after('gender'); // Husband, Wife, None
            $table->renameColumn('number_of_guests', 'number_of_children');
            $table->string('payment_method')->change(); // Change to string to support more methods easily
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reunion_applications', function (Blueprint $table) {
            $table->dropColumn('spouse_type');
            $table->renameColumn('number_of_children', 'number_of_guests');
            $table->enum('payment_method', ['bKash', 'Nagad'])->change();
        });
    }
};
