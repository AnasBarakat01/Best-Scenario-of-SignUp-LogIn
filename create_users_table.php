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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender',['male','female']);
            $table->date('birthDate');
            $table->string('profilePhoto',2048)->nullable();
            $table->string('region');
            $table->string('city');
            $table->string('phone');
            $table->integer('my_balance')->defalt(0);
            $table->integer('activated')->defalt(0);
            $table->string('activation_code',2048);
            $table->date('activation_expiry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
