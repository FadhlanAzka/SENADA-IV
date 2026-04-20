<?php

namespace App\Http\Controllers;

use App\Models\DataMoU;
use App\Imports\DataMoUImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class DataMoUController extends Controller
{

    public function updateAll()
{
    try {
        // Ambil semua data dari tabel datamou
        $dataMoUs = DataMoU::all();

        // Loop dan update setiap record
        foreach ($dataMoUs as $dataMoU) {
            $dataMoU->save(); // Memanggil metode boot untuk mengupdate kolom otomatis
        }

        return redirect()->route('datamou.index')->with('success', 'Semua data berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->route('datamou.index')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
    }
}
    public function showImportForm()
{
    return view('datamou.index'); // Atur ulang jika diperlukan
}

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv|max:2048',
    ]);

    try {
        Excel::import(new DataMoUImport, $request->file('file'));
        return redirect()->route('datamou.index')->with('success', 'Data berhasil diimpor.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat impor data: ' . $e->getMessage());
    }
}

    /**
     * Display a listing of MoU.
     */
    public function index(Request $request)
{
    $sort_by = $request->get('sort_by', 'id');
    $order = $request->get('order', 'desc');
    $search = $request->get('search');

    // Ambil nilai filter dari request
    $filters = $request->only([
        'filter_nama_mitra',
        'filter_tahun',
        'filter_jenis_mitra',
        'filter_jenis_kerjasama',
        'filter_masa_berlaku_mou_tahun',
        'filter_mulai_berlaku',
        'filter_tanggal_kadaluarsa',
        'filter_status_dokumen',
        'filter_status_kadaluarsa',
    ]);

    $query = DataMoU::query();

    // Filter berdasarkan kolom tertentu
    foreach ($filters as $key => $value) {
        if ($value) {
            $column = str_replace('filter_', '', $key); // Hapus prefix "filter_"

            // Periksa kolom dengan tipe data spesifik untuk pencocokan yang berbeda
            if (in_array($column, ['mulai_berlaku', 'tanggal_kadaluarsa'])) {
                $query->whereDate($column, $value);
            } else {
                $query->where($column, 'like', "%$value%");
            }
        }
    }

    // Pencarian
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('nama_mitra', 'like', "%$search%")
              ->orWhere('perihal', 'like', "%$search%")
              ->orWhere('jenis_mitra', 'like', "%$search%")
              ->orWhere('jenis_kerjasama', 'like', "%$search%")
              ->orWhere('nomor_agenda_mitra', 'like', "%$search%")
              ->orWhere('nomor_agenda_lldikti', 'like', "%$search%");
        });
    }

    $query->orderBy($sort_by, $order);

    $datamou = $query->paginate(10)->appends($request->all());

    // Mengambil daftar untuk suggestion
    $namaMitraList = DataMoU::select('nama_mitra')->distinct()->pluck('nama_mitra');
    $jenisMitraList = DataMoU::select('jenis_mitra')->distinct()->pluck('jenis_mitra');
    $jenisKerjasamaList = DataMoU::select('jenis_kerjasama')->distinct()->pluck('jenis_kerjasama');
    $perihalList = DataMoU::select('perihal')->distinct()->pluck('perihal');

    return view('datamou.index', compact(
        'datamou',
        'sort_by',
        'order',
        'search',
        'filters',
        'namaMitraList',
        'jenisMitraList',
        'jenisKerjasamaList',
        'perihalList'
    ));
}


    /**
     * Handle suggestions for autocomplete.
     */
    public function suggestion(Request $request)
    {
        $term = $request->get('term', ''); // Ambil term dari request

        // Cari suggestions berdasarkan input
        $suggestions = [];
        if ($request->has('field')) {
            $field = $request->get('field'); // Nama field yang ingin dicari
            if (in_array($field, ['nama_mitra', 'jenis_mitra', 'status_dokumen'])) {
                $suggestions = DataMoU::where($field, 'like', "%{$term}%")
                    ->pluck($field)
                    ->unique()
                    ->take(10); // Batasi hasil ke 10 suggestion
            }
        }

        return response()->json($suggestions); // Kembalikan sebagai JSON
    }

    /**
     * Show the form for creating a new MoU.
     */
    public function create()
    {
        return view('datamou.create');
    }

    /**
     * Store a newly created MoU in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_mitra' => 'required|string|max:128',
            'perihal' => 'nullable|string',
            'jenis_mitra' => 'required|in:Dunia Usaha & Dunia Industri,Pemerintah Daerah,Lembaga Pemerintah Non Pemerintah Daerah,Organisasi Nirlaba,Perguruan Tinggi Negeri,Perguruan Tinggi Swasta,Bank,Perguruan Tinggi Luar Negeri',
            'jenis_kerjasama' => 'nullable|in:Nota Kesepahaman,MoU Kerjasama,MoU Kesepakatan,Adendum Perjanjian,Konsorsium,MoU Kesepakatan Terpadu,Implementation Agreement',
            'masa_berlaku_mou_tahun' => 'nullable|integer',
            'mulai_berlaku' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'nomor_agenda_mitra' => 'nullable|string',
            'nomor_agenda_lldikti' => 'nullable|string',
            'status_dokumen' => 'required|in:Lengkap,Tidak Lengkap',
            'keterangan_dokumen' => 'nullable|string',
            'link_dokumen' => 'nullable|string',
            'bentuk_tindak_lanjut' => 'nullable|string',
        ]);

        DataMoU::create($request->all());
        return redirect()->route('datamou.index')->with('success', 'Data MoU berhasil dibuat.');
    }

    /**
     * Display the specified MoU.
     */
    public function show($id)
    {
        $datamou = DataMoU::findOrFail($id);
        return view('datamou.show', compact('datamou'));
    }

    /**
     * Show the form for editing the specified MoU.
     */
    public function edit($id)
    {
        $datamou = DataMoU::findOrFail($id);
        return view('datamou.edit', compact('datamou'));
    }

    /**
     * Update the specified MoU in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $datamou = DataMoU::findOrFail($id);

        $request->validate([
            'nama_mitra' => 'required|string|max:128',
            'perihal' => 'nullable|string',
            'jenis_mitra' => 'required|in:Dunia Usaha & Dunia Industri,Pemerintah Daerah,Lembaga Pemerintah Non Pemerintah Daerah,Organisasi Nirlaba,Perguruan Tinggi Negeri,Perguruan Tinggi Swasta,Bank,Perguruan Tinggi Luar Negeri',
            'jenis_kerjasama' => 'nullable|in:Nota Kesepahaman,MoU Kerjasama,MoU Kesepakatan,Adendum Perjanjian,Konsorsium,MoU Kesepakatan Terpadu,Implementation Agreement',
            'masa_berlaku_mou_tahun' => 'nullable|integer',
            'mulai_berlaku' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'nomor_agenda_mitra' => 'nullable|string',
            'nomor_agenda_lldikti' => 'nullable|string',
            'status_dokumen' => 'required|in:Lengkap,Tidak Lengkap',
            'keterangan_dokumen' => 'nullable|string',
            'link_dokumen' => 'nullable|string',
            'bentuk_tindak_lanjut' => 'nullable|string',
        ]);

        $datamou->update($request->all());
        return redirect()->route('datamou.index')->with('success', 'Data MoU berhasil diubah.');
    }

    /**
     * Remove the specified MoU from storage.
     */
    public function destroy(DataMoU $datamou): RedirectResponse
    {
        $datamou->delete();
        return redirect()->route('datamou.index')->with('success', 'Data MoU berhasil dihapus.');
    }

    /**
     * Dashboard for displaying MoU statistics.
     */
    public function dashboard()
    {
        $totalDataMou = DataMoU::count();
        $kerjasamaAktif = DataMoU::where('status_kadaluarsa', 'Aktif')->count();
        $kerjasamaMasaTenggang = DataMoU::where('status_kadaluarsa', 'Masa Tenggang')->count();
        $kerjasamaKadaluarsa = DataMoU::where('status_kadaluarsa', 'Kadaluarsa')->count();

        // Hitung jumlah kerjasama berdasarkan jenis mitra
        $ptn = DataMoU::where('jenis_mitra', 'Perguruan Tinggi Negeri')->count();
        $pts = DataMoU::where('jenis_mitra', 'Perguruan Tinggi Swasta')->count();
        $non_pt = DataMoU::whereNotIn('jenis_mitra', ['Perguruan Tinggi Negeri', 'Perguruan Tinggi Swasta'])->count();

        $dataPerTahun = DataMoU::selectRaw('YEAR(mulai_berlaku) as tahun, COUNT(*) as jumlah')
            ->groupByRaw('YEAR(mulai_berlaku)')
            ->orderBy('tahun')
            ->get()
            ->pluck('jumlah', 'tahun')
            ->toArray();

        return view('dashboard', compact(
            'totalDataMou',
            'kerjasamaAktif',
            'kerjasamaMasaTenggang',
            'kerjasamaKadaluarsa',
            'ptn',
            'pts',
            'non_pt',
            'dataPerTahun'
        ));
    }
}