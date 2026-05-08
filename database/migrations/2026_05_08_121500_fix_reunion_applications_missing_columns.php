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
            if (!Schema::hasColumn('reunion_applications', 'member_type')) {
                $table->string('member_type')->nullable()->after('spouse_type');
            }

            if (!Schema::hasColumn('reunion_applications', 'tshirt_size')) {
                $table->string('tshirt_size')->nullable()->after('member_type');
            }

            if (!Schema::hasColumn('reunion_applications', 'number_of_children')) {
                $table->integer('number_of_children')->default(0)->after('tshirt_size');
            }

            if (!Schema::hasColumn('reunion_applications', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('number_of_children');
            }

            if (!Schema::hasColumn('reunion_applications', 'donation_amount')) {
                $table->integer('donation_amount')->default(0)->after('payment_method');
            }

            if (!Schema::hasColumn('reunion_applications', 'transaction_number')) {
                $table->string('transaction_number')->nullable()->after('donation_amount');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reunion_applications', function (Blueprint $table) {
            $drop = [];
            foreach ([
                'transaction_number',
                'donation_amount',
                'payment_method',
                'number_of_children',
                'tshirt_size',
                'member_type',
            ] as $col) {
                if (Schema::hasColumn('reunion_applications', $col)) {
                    $drop[] = $col;
                }
            }

            if (!empty($drop)) {
                $table->dropColumn($drop);
            }
        });
    }
};
