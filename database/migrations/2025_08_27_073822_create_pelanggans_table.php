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
        Schema::create('pelanggans', function (Blueprint $table) {
        $table->id();
        $table->string('no_ktp', 16)->unique();
        $table->string('nama_lengkap', 255);
        $table->string('tempat_lahir', 100);
        $table->date('tanggal_lahir');
        $table->enum('jenis_kelamin', ['L','P']);
        $table->enum('status_pernikahan', ['Menikah','Belum Menikah']);

        $table->text('alamat_ktp');
        $table->foreignId('provinsi_ktp_id')->constrained('provinsis');
        $table->foreignId('kabupaten_ktp_id')->constrained('kabupatens');
        $table->foreignId('kecamatan_ktp_id')->constrained('kecamatans');
        $table->foreignId('kelurahan_ktp_id')->constrained('kelurahans');
        $table->string('kodepos_ktp', 10)->nullable();

        $table->text('alamat_instalasi');
        $table->foreignId('provinsi_instalasi_id')->constrained('provinsis');
        $table->foreignId('kabupaten_instalasi_id')->constrained('kabupatens');
        $table->foreignId('kecamatan_instalasi_id')->constrained('kecamatans');
        $table->foreignId('kelurahan_instalasi_id')->constrained('kelurahans');
        $table->string('kodepos_instalasi', 10)->nullable();

        $table->string('pekerjaan', 100);
        $table->string('jenis_tempat_tinggal', 100);
        $table->string('nomor_telepon', 20)->nullable();
        $table->string('nomor_ponsel', 20);
        $table->string('no_fax', 20)->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
