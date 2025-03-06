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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('order_payment_type',['prepaid','cod'])->default('prepaid');
            $table->enum('delivery_type',['simple','premium'])->default('simple');
            $table->enum('order_type',['normal','manufacturing'])->default('normal');
            $table->integer('product_founder')->default('0');
            $table->integer('customer_id')->default('0');
            $table->integer('exicutive_id')->default('0');
            $table->date('date');
            $table->decimal('amount', $precision = 8, $scale = 2);
            $table->string('feedback');
            $table->string('comment');
            $table->enum('status',['pending','reject','approved'])->default('pending');
            $table->enum('payment_status',['pending','reject','approved'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
