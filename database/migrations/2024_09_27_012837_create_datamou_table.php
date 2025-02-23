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
        Schema::create('datamou', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra', 128);
            $table->text('perihal')-> nullable();
            $table->year('tahun')-> nullable();
            $table->string('jenis_mitra', 64)-> nullable();
            $table->string('jenis_kerjasama', 64)-> nullable();
            $table->integer('masa_berlaku_mou_tahun')-> nullable();
            $table->date('mulai_berlaku')-> nullable();
            $table->date('tanggal_kadaluarsa')-> nullable();
            $table->text('nomor_agenda_mitra')-> nullable();
            $table->text('nomor_agenda_lldikti')-> nullable();
            $table->enum('status_dokumen', ['Lengkap', 'Tidak Lengkap']);
            $table->text('keterangan_dokumen')-> nullable();
            $table->text('link_dokumen')-> nullable();
            $table->text('bentuk_tindak_lanjut')-> nullable();
            $table->enum('status_kadaluarsa', ['Belum Kadaluarsa', 'Hampir Kadaluarsa', 'Sudah Kadaluarsa'])-> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datamou');
    }
};
