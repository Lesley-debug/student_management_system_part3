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
        Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('enrollment_id')->constrained('enrollments')->onDelete('cascade');
        //$table->unsignedBigInteger('enrollment_id');
        $table->string('receipt_no')->unique;
        $table->decimal('amount', 10, 2);
        $table->date('payment_date');
        $table->string('method')->nullable(); // cash, card, bank, etc.
        $table->timestamps();
        $table->softDeletes();  // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
