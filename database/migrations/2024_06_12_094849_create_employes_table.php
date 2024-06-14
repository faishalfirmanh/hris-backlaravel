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
        Schema::create('employes', function (Blueprint $table) {
            $table->id('id');
            $table->string('fullname');
            $table->string('username');
            $table->string('password');
            $table->tinyInteger('type_employe')->nullable()->default(0);
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('file_cv');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
