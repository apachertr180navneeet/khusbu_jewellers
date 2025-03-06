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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->default('0');
            $table->string('payment_screen_shot')->nullable();
            $table->date('date');
            $table->decimal('paid_amount', $precision = 8, $scale = 2);
            $table->enum('payment_via',['upi','cheque','cash'])->default('upi');
            $table->string('utr_id')->nullable();
            $table->decimal('total_amount', $precision = 8, $scale = 2);
            $table->decimal('adv_amount', $precision = 8, $scale = 2);
            $table->decimal('cod_amount', $precision = 8, $scale = 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
