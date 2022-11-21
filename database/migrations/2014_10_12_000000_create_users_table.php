<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('password');
            $table->boolean('admin')->default(false);
            $table->boolean('challenge1')->default(false);
            $table->boolean('challenge2')->default(false);
            $table->boolean('challenge3')->default(false);
            $table->boolean('challenge4')->default(false);
            $table->boolean('challenge5')->default(false);
            $table->boolean('disabled')->default(false);
            $table->string('avatar')->default('default.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
