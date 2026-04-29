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
            $table->enum('member_type', ['guest', 'ex_student', 'running_student'])->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('photo')->nullable();
            $table->integer('number_of_guests')->default(0);
            $table->boolean('wants_to_perform')->default(false);
            $table->string('performance_type')->nullable();
            $table->text('message_to_teachers')->nullable();
            $table->integer('donation_amount')->default(0);
            $table->enum('payment_method', ['bKash', 'Nagad'])->nullable();
            $table->string('transaction_number')->nullable();
            $table->text('donation_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reunion_applications', function (Blueprint $table) {
            $table->dropColumn([
                'member_type',
                'gender',
                'present_address',
                'permanent_address',
                'photo',
                'number_of_guests',
                'wants_to_perform',
                'performance_type',
                'message_to_teachers',
                'donation_amount',
                'payment_method',
                'transaction_number',
                'donation_message',
            ]);
        });
    }
};
