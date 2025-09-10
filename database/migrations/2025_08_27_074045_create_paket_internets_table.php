<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('paket_internets', function (Blueprint $table) {
        $table->id();
        $table->string('nama_paket', 150);
        $table->string('paket_internet', 100);
        $table->decimal('harga_bulanan', 10, 2);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_internets');
    }
};
