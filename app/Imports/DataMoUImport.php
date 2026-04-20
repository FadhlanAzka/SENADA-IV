<?php

namespace App\Imports;

use App\Models\DataMoU;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataMoUImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
{
    return new DataMoU([
        'nama_mitra' => $row[0] ?? 'Mitra Tidak Diketahui', // Default untuk nama_mitra
            'perihal' => $row[1],                               // Tidak ada default
            'jenis_mitra' => $row[2],                           // Tidak ada default
            'jenis_kerjasama' => $row[3],                       // Tidak ada default
            'mulai_berlaku' => $this->parseDate($row[4]),
            'tanggal_kadaluarsa' => $this->parseDate($row[5]),
            'nomor_agenda_mitra' => $row[6],                    // Tidak ada default
            'nomor_agenda_lldikti' => $row[7],                  // Tidak ada default
            'status_dokumen' => $row[8] ?? 'Tidak Lengkap',     // Default untuk status_dokumen
            'keterangan_dokumen' => $row[9],                    // Tidak ada default
            'link_dokumen' => $row[10],                         // Tidak ada default
            'bentuk_tindak_lanjut' => $row[11],                 // Tidak ada default
    ]);
}

/**
 * Normalize `jenis_mitra` values.
 */
private function normalizeJenisMitra($value)
{
    $map = [
        'PTS' => 'Perguruan Tinggi Swasta',
        'PTN' => 'Perguruan Tinggi Negeri',
        'PTLN' => 'Perguruan Tinggi Luar Negeri',
    ];

    return $map[$value] ?? $value; // Kembalikan nilai asli jika tidak ada di map
}

/**
 * Normalize `jenis_kerjasama` values.
 */
private function normalizeJenisKerjasama($value)
{
    $map = [
        'MoU Kesepakatan' => 'MoU Kesepakatan Terpadu', // Sesuaikan dengan enum yang valid
    ];

    return $map[$value] ?? $value; // Kembalikan nilai asli jika tidak ada di map
}

/**
 * Parse date to MySQL format.
 */
private function parseDate($date)
{
    $formats = ['Y-m-d H:i:s', 'd/m/Y', 'm/d/Y'];
    foreach ($formats as $format) {
        try {
            return \Carbon\Carbon::createFromFormat($format, $date)->format('Y-m-d');
        } catch (\Exception $e) {
            continue;
        }
    }
    return null; // Return null if no format matches
}
}