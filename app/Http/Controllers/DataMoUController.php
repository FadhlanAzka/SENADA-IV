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
    public function index(): View
    {
        $datamou = DataMou::paginate(10);
        return view('datamou.index', compact('datamou'));
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
    $request->validate([
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
    ]);
    
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

        $request->validate([
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
        ]);
        
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
}