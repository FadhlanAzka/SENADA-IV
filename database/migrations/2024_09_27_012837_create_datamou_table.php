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
        Schema::create('datamou', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra', 128);
            $table->text('perihal')->nullable();
            $table->year('tahun')->nullable();
            $table->enum('jenis_mitra', [
                'Dunia Usaha & Dunia Industri',
                'Pemerintah Daerah',
                'Lembaga Pemerintah Non Pemerintah Daerah',
                'Organisasi Nirlaba',
                'Perguruan Tinggi Negeri',
                'Perguruan Tinggi Swasta',
                'Bank',
                'Perguruan Tinggi Luar Negeri',
            ])->nullable();
            $table->enum('jenis_kerjasama', [
                'Nota Kesepahaman',
                'MoU Kerjasama',
                'MoU Kesepakatan',
                'Adendum Perjanjian',
                'Konsorsium',
                'MoU Kesepakatan Terpadu',
                'Implementation Agreement',
            ])->nullable();
            $table->unsignedTinyInteger('masa_berlaku_mou_tahun')->nullable();
            $table->date('mulai_berlaku')->nullable();
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->text('nomor_agenda_mitra')->nullable();
            $table->text('nomor_agenda_lldikti')->nullable();
            $table->enum('status_dokumen', ['Lengkap', 'Tidak Lengkap']);
            $table->text('keterangan_dokumen')->nullable();
            $table->text('link_dokumen')->nullable();
            $table->text('bentuk_tindak_lanjut')->nullable();
            $table->enum('status_kadaluarsa', ['Aktif', 'Masa Tenggang', 'Kadaluarsa', ''])->nullable();
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
        Schema::dropIfExists('datamou');
    }
};