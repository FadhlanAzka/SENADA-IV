@extends('layouts.user_type.auth')

@section('content')
<div class="card mt-5">
  <h2 class="card-header">Edit Data MoU</h2>
  <div class="card-body">
  
    <form action="{{ route('datamou.update', $datamou->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="inputNamaMitra" class="form-label"><strong>Nama Mitra</strong></label>
            <input 
                type="text" 
                name="nama_mitra" 
                class="form-control @error('nama_mitra') is-invalid @enderror" 
                id="inputNamaMitra" 
                value="{{ old('nama_mitra', $datamou->nama_mitra) }}" 
                placeholder="Nama Mitra">
            @error('nama_mitra')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
  
        <div class="mb-3">
            <label for="inputPerihal" class="form-label"><strong>Perihal:</strong></label>
            <textarea 
                class="form-control @error('perihal') is-invalid @enderror" 
                style="height:150px" 
                name="perihal" 
                id="inputPerihal" 
                placeholder="Perihal">{{ old('perihal', $datamou->perihal) }}</textarea>
            @error('perihal')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputTahun" class="form-label"><strong>Tahun:</strong></label>
            <input 
                type="number" 
                name="tahun" 
                class="form-control @error('tahun') is-invalid @enderror" 
                id="inputTahun" 
                value="{{ old('tahun', $datamou->tahun) }}" 
                placeholder="Tahun">
            @error('tahun')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputJenisMitra" class="form-label"><strong>Jenis Mitra:</strong></label>
            <input 
                type="text" 
                name="jenis_mitra" 
                class="form-control @error('jenis_mitra') is-invalid @enderror" 
                id="inputJenisMitra" 
                value="{{ old('jenis_mitra', $datamou->jenis_mitra) }}" 
                placeholder="Jenis Mitra">
            @error('jenis_mitra')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputJenisKerjasama" class="form-label"><strong>Jenis Kerjasama:</strong></label>
            <input 
                type="text" 
                name="jenis_kerjasama" 
                class="form-control @error('jenis_kerjasama') is-invalid @enderror" 
                id="inputJenisKerjasama" 
                value="{{ old('jenis_kerjasama', $datamou->jenis_kerjasama) }}" 
                placeholder="Jenis Kerjasama">
            @error('jenis_kerjasama')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputMasaBerlaku" class="form-label"><strong>Masa Berlaku:</strong></label>
            <div class="input-group">
                <input 
                    type="number" 
                    name="masa_berlaku_mou_tahun" 
                    class="form-control @error('masa_berlaku_mou_tahun') is-invalid @enderror" 
                    id="inputMasaBerlaku" 
                    value="{{ old('masa_berlaku_mou_tahun', $datamou->masa_berlaku_mou_tahun) }}" 
                    placeholder="Masa Berlaku" 
                    aria-label="Masa Berlaku">
                <span class="input-group-text">Tahun</span>
            </div>
            @error('masa_berlaku_mou_tahun')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputMulaiBerlaku" class="form-label"><strong>Mulai Berlaku:</strong></label>
            <input 
                type="date" 
                name="mulai_berlaku" 
                class="form-control @error('mulai_berlaku') is-invalid @enderror" 
                id="inputMulaiBerlaku" 
                value="{{ old('mulai_berlaku', $datamou->mulai_berlaku) }}">
            @error('mulai_berlaku')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputKadaluarsa" class="form-label"><strong>Kadaluarsa:</strong></label>
            <input 
                type="date" 
                name="tanggal_kadaluarsa" 
                class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror" 
                id="inputKadaluarsa" 
                value="{{ old('tanggal_kadaluarsa', $datamou->tanggal_kadaluarsa) }}">
            @error('tanggal_kadaluarsa')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputNomorAgendaMitra" class="form-label"><strong>Nomor Agenda Mitra:</strong></label>
            <input 
                type="text" 
                name="nomor_agenda_mitra" 
                class="form-control @error('nomor_agenda_mitra') is-invalid @enderror" 
                id="inputNomorAgendaMitra" 
                value="{{ old('nomor_agenda_mitra', $datamou->nomor_agenda_mitra) }}" 
                placeholder="Nomor Agenda Mitra">
            @error('nomor_agenda_mitra')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputNomorAgendaLldikti" class="form-label"><strong>Nomor Agenda LLDikti:</strong></label>
            <input 
                type="text" 
                name="nomor_agenda_lldikti" 
                class="form-control @error('nomor_agenda_lldikti') is-invalid @enderror" 
                id="inputNomorAgendaLldikti" 
                value="{{ old('nomor_agenda_lldikti', $datamou->nomor_agenda_lldikti) }}" 
                placeholder="Nomor Agenda LLDikti">
            @error('nomor_agenda_lldikti')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputStatusDokumen" class="form-label"><strong>Status Dokumen:</strong></label>
            <select 
                name="status_dokumen" 
                class="form-select @error('status_dokumen') is-invalid @enderror" 
                id="inputStatusDokumen">
                <option value="">Pilih Status</option>
                <option value="Lengkap" {{ old('status_dokumen', $datamou->status_dokumen) == 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
                <option value="Tidak Lengkap" {{ old('status_dokumen', $datamou->status_dokumen) == 'Tidak Lengkap' ? 'selected' : '' }}>Tidak Lengkap</option>
            </select>
            @error('status_dokumen')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputKeteranganDokumen" class="form-label"><strong>Keterangan Dokumen:</strong></label>
            <textarea 
                class="form-control @error('keterangan_dokumen') is-invalid @enderror" 
                style="height:150px" 
                name="keterangan_dokumen" 
                id="inputKeteranganDokumen" 
                placeholder="Keterangan Dokumen">{{ old('keterangan_dokumen', $datamou->keterangan_dokumen) }}</textarea>
            @error('keterangan_dokumen')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputFile" class="form-label"><strong>File (Link Google Drive):</strong></label>
            <textarea 
                name="link_dokumen" 
                class="form-control @error('link_dokumen') is-invalid @enderror" 
                id="inputFile" 
                placeholder="Masukkan link Google Drive di sini..." 
                rows="3">{{ old('link_dokumen', $datamou->link_dokumen) }}</textarea>
            @error('link_dokumen')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputBentukTindakLanjut" class="form-label"><strong>Bentuk Tindak Lanjut:</strong></label>
            <textarea 
                class="form-control @error('bentuk_tindak_lanjut') is-invalid @enderror" 
                style="height:150px" 
                name="bentuk_tindak_lanjut" 
                id="inputBentukTindakLanjut" 
                placeholder="Bentuk Tindak Lanjut">{{ old('bentuk_tindak_lanjut', $datamou->bentuk_tindak_lanjut) }}</textarea>
            @error('bentuk_tindak_lanjut')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 d-flex justify-content-between">
        <a class="btn btn-primary" href="{{ route('datamou.show', $datamou->id) }}">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </form>
  </div>
</div>
@endsection