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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_id_pelanggan', 20)->unique();
            $table->date('tanggal_daftar');

            $table->foreignId('pelanggan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('paket_internet_id')->constrained()->cascadeOnDelete();
            $table->string('paket_internet_custom')->nullable();
            $table->decimal('paket_internet_harga_custom', 10, 2)->nullable();
            $table->foreignId('promosi_id')->nullable()->constrained() ->nullOnDelete();
            $table->foreignId('bandwidth_id')->constrained()->cascadeOnDelete();
            $table->string('bandwidth_manual')->nullable();

            $table->enum('metode_billing', ['Cetak','E-Billing']);
            $table->text('alamat_penagihan');
            $table->string('email_penagihan', 255);
            $table->string('metode_pembayaran');
            $table->string('nomor_kartu_kredit', 50);
            $table->string('masa_berlaku_kartu', 10);

            $table->decimal('biaya_registrasi', 10, 2)->default(0);
            $table->decimal('biaya_paket_internet', 10, 2)->default(0);
            $table->decimal('biaya_maintenance', 10, 2)->default(0);
            $table->decimal('ppn_persen', 5, 2)->default(10.00);
            $table->decimal('ppn_nominal', 10, 2)->default(0);
            $table->decimal('total_biaya_per_bulan', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
