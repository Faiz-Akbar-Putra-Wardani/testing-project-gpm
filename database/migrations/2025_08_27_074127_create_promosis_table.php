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
        Schema::create('promosis', function (Blueprint $table) {
        $table->id();
        $table->string('kode_promosi', 50)->unique()->nullable();
        $table->string('nama_program_promosi', 255)->nullable();
        $table->date('periode_mulai')->nullable();
        $table->date('periode_selesai')->nullable();
        $table->text('note')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosis');
    }
};
