<?php

namespace App\Http\Controllers;

use App\Models\DataMoU;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DataMoUController extends Controller
{    
    /**
     * Display a listing of MoU.
     *
     * @return View
     */
    public function index(Request $request): View
{
    // Default sorting parameters
    $sort_by = $request->get('sort_by', 'id'); // Default to 'id'
    $order = $request->get('order', 'desc'); // Default order to 'asc'

    // Status filter
    $filter = $request->get('status_filter');

    // Query initialization
    $query = DataMoU::query();

    // Apply status filtering if applicable
    if ($filter == 'belum_kadaluarsa') {
        $query->where('tanggal_kadaluarsa', '>', now());
    } elseif ($filter == 'sudah_kadaluarsa') {
        $query->where('tanggal_kadaluarsa', '<=', now());
    }

    // Sort by the specified column
    $query->orderBy($sort_by, $order);

    $datamou = $query->paginate(10)->appends($request->all()); // Append the request input for pagination links

    return view('datamou.index', compact('datamou', 'sort_by', 'order', 'filter'));
}




    /**
     * Show the form for creating a new MoU.
     *
     * @return View
     */
    public function create(): View
    {
        return view('datamou.create');
    }

    /**
 * Store a newly created MoU in storage.
 *
 * @param  Request $request
 * @return RedirectResponse
 */
public function store(Request $request): RedirectResponse
{
    $rules = [
        'nama_mitra' => 'required|string|max:128',
        'perihal' => 'required|string',
        'tahun' => 'required|integer',
        'jenis_mitra' => 'required|string|max:64',
        'jenis_kerjasama' => 'required|string|max:64',
        'masa_berlaku_mou_tahun' => 'required|integer',
        'mulai_berlaku' => 'required|date',
        'tanggal_kadaluarsa' => 'required|date',
        'nomor_agenda_mitra' => 'required|string',
        'nomor_agenda_lldikti' => 'required|string',
        'status_dokumen' => 'required|in:Lengkap,Tidak Lengkap',
        'keterangan_dokumen' => 'nullable|string',
        'link_dokumen' => 'nullable|string',
        'bentuk_tindak_lanjut' => 'nullable|string',
    ];

    if ($request->input('status_dokumen') === 'Tidak Lengkap') {
        // Aturan untuk 'Tidak Lengkap'
        $rules = array_merge($rules, [
            'perihal' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'jenis_mitra' => 'nullable|string|max:64',
            'jenis_kerjasama' => 'nullable|string|max:64',
            'masa_berlaku_mou_tahun' => 'nullable|integer',
            'mulai_berlaku' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'nomor_agenda_mitra' => 'nullable|string',
            'nomor_agenda_lldikti' => 'nullable|string',
            'keterangan_dokumen' => 'nullable|string',
            'link_dokumen' => 'nullable|string',
            'bentuk_tindak_lanjut' => 'nullable|string',
        ]);
    }

    $request->validate($rules);

    $fileLinks = $request->input('link_dokumen');
    DataMoU::create(array_merge($request->all(), ['link_dokumen' => $fileLinks]));
    return redirect()->route('datamou.index')->with('success', 'Data MoU berhasil dibuat.');
}

/**
     * Display the specified MoU.
     *
     * @param  string $id
     * @return View
     */
    public function show(string $id): View
    {
        $datamou = DataMoU::findOrFail($id);
        return view('datamou.show', compact('datamou'));
    }


    /**
     * Show the form for editing the specified MoU.
     *
     * @param  string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $datamou = DataMoU::findOrFail($id);
        return view('datamou.edit', compact('datamou'));
    }

    /**
     * Update the specified MoU in storage.
     *
     * @param  Request $request
     * @param  string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
{
    $datamou = DataMoU::findOrFail($id);

    $rules = [
        'nama_mitra' => 'required|string|max:128',
        'perihal' => 'required|string',
        'tahun' => 'required|integer',
        'jenis_mitra' => 'required|string|max:64',
        'jenis_kerjasama' => 'required|string|max:64',
        'masa_berlaku_mou_tahun' => 'required|integer',
        'mulai_berlaku' => 'required|date',
        'tanggal_kadaluarsa' => 'required|date',
        'nomor_agenda_mitra' => 'required|string',
        'nomor_agenda_lldikti' => 'required|string',
        'status_dokumen' => 'required|in:Lengkap,Tidak Lengkap',
        'keterangan_dokumen' => 'nullable|string',
        'link_dokumen' => 'nullable|string',
        'bentuk_tindak_lanjut' => 'nullable|string',
    ];

    if ($request->input('status_dokumen') === 'Tidak Lengkap') {
        // Aturan untuk 'Tidak Lengkap'
        $rules = array_merge($rules, [
            'perihal' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'jenis_mitra' => 'nullable|string|max:64',
            'jenis_kerjasama' => 'nullable|string|max:64',
            'masa_berlaku_mou_tahun' => 'nullable|integer',
            'mulai_berlaku' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'nomor_agenda_mitra' => 'nullable|string',
            'nomor_agenda_lldikti' => 'nullable|string',
            'keterangan_dokumen' => 'nullable|string',
            'link_dokumen' => 'nullable|string',
            'bentuk_tindak_lanjut' => 'nullable|string',
        ]);
    }

    $request->validate($rules);

    $fileLinks = $request->input('link_dokumen');
    $datamou->update(array_merge($request->all(), ['link_dokumen' => $fileLinks]));
    return redirect()->route('datamou.index')->with('success', 'Data Berhasil Diubah!');
}

    /**
     * Remove the specified MoU from storage.
     *
     * @param  DataMoU $dataMoU
     * @return RedirectResponse
     */
    public function destroy(DataMoU $datamou): RedirectResponse
    {
        $datamou->delete();
        return redirect()->route('datamou.index')->with('success', 'Data MoU berhasil dihapus.');
    }

    public function dashboard(): View
{
    // Total Data MoU
    $totalDataMou = DataMoU::count();

    // Kerjasama Aktif: tanggal kadaluarsa lebih dari hari ini
    $kerjasamaAktif = DataMoU::where('tanggal_kadaluarsa', '>', now())->count();

    // Kerjasama Hampir Kadaluarsa: kadaluarsa dalam 30 hari ke depan
    $kerjasamaHampirKadaluarsa = DataMoU::whereBetween('tanggal_kadaluarsa', [now(), now()->addDays(180)])->count();

    // Kerjasama Kadaluarsa: tanggal kadaluarsa sudah lewat
    $kerjasamaKadaluarsa = DataMoU::where('tanggal_kadaluarsa', '<=', now())->count();

    // Hitung jumlah berdasarkan jenis mitra
    $ptn = DataMoU::where('jenis_mitra', 'PTN')->count();
    $pts = DataMoU::where('jenis_mitra', 'PTS')->count();
    $non_pt = DataMoU::whereNotIn('jenis_mitra', ['PTN', 'PTS'])->count();

    // Menghitung jumlah berdasarkan tahun (2022, 2023, 2024)
    $dataPerTahun = DataMoU::selectRaw('YEAR(tahun) as tahun, count(*) as jumlah')
        ->whereIn('tahun', [2022, 2023, 2024])
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->pluck('jumlah', 'tahun')
        ->toArray();

    // Menyusun data per tahun agar selalu ada (untuk tahun yang tidak ada data, isi dengan 0)
    $dataPerTahun = [
        2022 => $dataPerTahun[2022] ?? 0,
        2023 => $dataPerTahun[2023] ?? 0,
        2024 => $dataPerTahun[2024] ?? 0,
    ];

    return view('dashboard', compact(
        'totalDataMou',
        'kerjasamaAktif',
        'kerjasamaHampirKadaluarsa',
        'kerjasamaKadaluarsa',
        'ptn',
        'pts',
        'non_pt',
        'dataPerTahun' // Menambahkan data per tahun ke view
    ));
}

}