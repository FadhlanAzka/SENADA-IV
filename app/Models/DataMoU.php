<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class DataMoU extends Model
{
    use HasFactory;

    protected $table = 'datamou';
    protected $fillable = [
        'nama_mitra',
        'perihal',
        'tahun',
        'jenis_mitra',
        'jenis_kerjasama',
        'masa_berlaku_mou_tahun',
        'mulai_berlaku',
        'tanggal_kadaluarsa',
        'nomor_agenda_mitra',
        'nomor_agenda_lldikti',
        'status_dokumen',
        'keterangan_dokumen',
        'link_dokumen',
        'bentuk_tindak_lanjut',
    ];    

    public function getStatusKadaluarsaAttribute()
{
    $currentDate = Carbon::now();
    $tanggalKadaluarsa = Carbon::parse($this->tanggal_kadaluarsa);

    if ($tanggalKadaluarsa <= $currentDate) {
        return 'Sudah Kadaluarsa';
    } else {
        return 'Belum Kadaluarsa';
    }
}
}