<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('cartlists', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('provider_id');
            $table->integer('cart_id');
            $table->text('cart_name');
            $table->char('cart_number');
            $table->integer('cart_cvc');
            $table->integer('cart_secure');
            $table->integer('cart_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        //
    }
};
