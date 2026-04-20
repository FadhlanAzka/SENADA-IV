<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatamouTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datamou', function (Blueprint $table) {
            $table->id(); // bigint(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('nama_mitra', 128); // varchar(128) NOT NULL
            $table->text('perihal')->nullable(); // text DEFAULT NULL
            $table->year('tahun')->nullable(); // year(4) DEFAULT NULL
            $table->enum('jenis_mitra', [
                'Dunia Usaha & Dunia Industri',
                'Pemerintah Daerah',
                'Lembaga Pemerintah Non Pemerintah Daerah',
                'Organisasi Nirlaba',
                'Perguruan Tinggi Negeri',
                'Perguruan Tinggi Swasta',
                'Bank',
                'Perguruan Tinggi Luar Negeri',
            ])->nullable(); // enum(...) DEFAULT NULL
            $table->string('jenis_kerjasama', 64)->nullable(); // varchar(64) DEFAULT NULL
            $table->unsignedTinyInteger('masa_berlaku_mou_tahun')->nullable(); // int(2) DEFAULT NULL
            $table->date('mulai_berlaku')->nullable(); // date DEFAULT NULL
            $table->date('tanggal_kadaluarsa')->nullable(); // date DEFAULT NULL
            $table->text('nomor_agenda_mitra')->nullable(); // text DEFAULT NULL
            $table->text('nomor_agenda_lldikti')->nullable(); // text DEFAULT NULL
            $table->enum('status_dokumen', ['Lengkap', 'Tidak Lengkap']); // enum(...) NOT NULL
            $table->text('keterangan_dokumen')->nullable(); // text DEFAULT NULL
            $table->text('link_dokumen')->nullable(); // text DEFAULT NULL
            $table->text('bentuk_tindak_lanjut')->nullable(); // text DEFAULT NULL
            $table->enum('status_kadaluarsa', ['Aktif', 'Masa Tenggang', 'Kadaluarsa', ''])->nullable(); // enum(...) DEFAULT NULL
            $table->timestamps(); // created_at and updated_at
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
}