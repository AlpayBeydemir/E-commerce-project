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
        Schema::create('discount', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('name');
            $table->text('description');
            $table->decimal('discount_percent');
            $table->string('discount_unit');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('coupon_code');
            $table->tinyInteger('active')->default(0)->comment('0 => Active, 1 => Inactive');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount');
    }
};
