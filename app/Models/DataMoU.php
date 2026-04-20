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

    protected $casts = [
        'masa_berlaku_mou_tahun' => 'integer',
        'mulai_berlaku' => 'date',
        'tanggal_kadaluarsa' => 'date',
    ];

    public function setTanggalAttribute($value)
{
    $formats = ['d/m/Y', 'm/d/Y', 'Y-m-d'];

    foreach ($formats as $format) {
        try {
            // Jika berhasil dengan salah satu format, tetapkan atributnya
            $this->attributes['mulai_berlaku'] = Carbon::createFromFormat($format, $value)->format('Y-m-d');
            return; // Keluar dari fungsi setelah berhasil
        } catch (\Exception $e) {
            // Lanjutkan ke format berikutnya jika ada kesalahan
            continue;
        }
    }

    // Jika tidak ada format yang cocok, log atau tetapkan nilai default
    \Log::error("Format tanggal tidak valid untuk nilai: {$value}");
    $this->attributes['mulai_berlaku'] = null; // Tetapkan nilai default
}

    public function setTanggalKadaluarsaAttribute($value)
{
    $formats = ['d/m/Y', 'm/d/Y', 'Y-m-d'];

    foreach ($formats as $format) {
        try {
            // Jika berhasil dengan salah satu format, tetapkan atributnya
            $this->attributes['tanggal_kadaluarsa'] = Carbon::createFromFormat($format, $value)->format('Y-m-d');
            return; // Keluar dari fungsi setelah berhasil
        } catch (\Exception $e) {
            // Lanjutkan ke format berikutnya jika ada kesalahan
            continue;
        }
    }

    // Jika tidak ada format yang cocok, log atau tetapkan nilai default
    \Log::error("Format tanggal tidak valid untuk nilai: {$value}");
    $this->attributes['tanggal_kadaluarsa'] = null; // Tetapkan nilai default
}


    /**
     * Boot method to handle automatic updates for 'status_kadaluarsa', 'tahun', and 'masa_berlaku_mou_tahun'.
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($datamou) {
            // Set 'status_kadaluarsa' automatically
            $datamou->status_kadaluarsa = $datamou->calculateKadaluarsaStatus(
                $datamou->mulai_berlaku,
                $datamou->tanggal_kadaluarsa
            );

            // Set 'tahun' automatically based on 'mulai_berlaku'
            if ($datamou->mulai_berlaku) {
                $datamou->tahun = Carbon::parse($datamou->mulai_berlaku)->year;
            }

            // Set 'masa_berlaku_mou_tahun' automatically
            $datamou->masa_berlaku_mou_tahun = $datamou->calculateMasaBerlaku(
                $datamou->mulai_berlaku,
                $datamou->tanggal_kadaluarsa
            );
        });
    }

    /**
     * Calculate the expiration status based on the current date.
     */
    private function calculateKadaluarsaStatus($mulaiBerlaku, $tanggalKadaluarsa)
    {
        if (!$mulaiBerlaku || !$tanggalKadaluarsa) {
            return null;
        }

        $today = Carbon::today();
        $expirationDate = Carbon::parse($tanggalKadaluarsa);

        if ($today->gt($expirationDate)) {
            return 'Kadaluarsa';
        } elseif ($today->diffInMonths($expirationDate) < 3 && $today->lte($expirationDate)) {
            return 'Masa Tenggang';
        } elseif ($today->lte($expirationDate)) {
            return 'Aktif';
        }

        return null;
    }

    /**
     * Calculate masa berlaku in years.
     */
    private function calculateMasaBerlaku($mulaiBerlaku, $tanggalKadaluarsa)
    {
        if (!$mulaiBerlaku || !$tanggalKadaluarsa) {
            return null;
        }

        return Carbon::parse($tanggalKadaluarsa)->year - Carbon::parse($mulaiBerlaku)->year;
    }

    /**
     * Dynamic attribute for 'status_kadaluarsa'.
     * This allows recalculation on-the-fly without storing in the database.
     */
    public function getStatusKadaluarsaDynamicAttribute()
    {
        return $this->calculateKadaluarsaStatus($this->mulai_berlaku, $this->tanggal_kadaluarsa);
    }
}