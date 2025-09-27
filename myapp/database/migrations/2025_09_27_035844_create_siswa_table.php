<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('nis', 20)->unique();
            $table->string('kelas', 150);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
