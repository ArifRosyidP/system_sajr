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
        Schema::create('clients', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('nomor_hp',20)->nullable();
            $table->string('npwp')->nullable();
            $table->foreignUuid('id_user')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
