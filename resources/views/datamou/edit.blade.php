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
            <label for="inputJenisMitra" class="form-label"><strong>Jenis Mitra:</strong></label>
            <select 
                name="jenis_mitra" 
                class="form-select @error('jenis_mitra') is-invalid @enderror" 
                id="inputJenisMitra">
                <option value="">Pilih Jenis Mitra</option>
                <option value="Dunia Usaha & Dunia Industri" {{ old('jenis_mitra', $datamou->jenis_mitra) == 'Dunia Usaha & Dunia Industri' ? 'selected' : '' }}>Dunia Usaha & Dunia Industri</option>
                <option value="Pemerintah Daerah" {{ old('jenis_mitra', $datamou->jenis_mitra) == 'Pemerintah Daerah' ? 'selected' : '' }}>Pemerintah Daerah</option>
                <option value="Lembaga Pemerintah Non Pemerintah Daerah" {{ old('jenis_mitra', $datamou->jenis_mitra) == 'Lembaga Pemerintah Non Pemerintah Daerah' ? 'selected' : '' }}>Lembaga Pemerintah Non Pemerintah Daerah</option>
                <option value="Organisasi Nirlaba" {{ old('jenis_mitra', $datamou->jenis_mitra) == 'Organisasi Nirlaba' ? 'selected' : '' }}>Organisasi Nirlaba</option>
                <option value="Perguruan Tinggi Negeri" {{ old('jenis_mitra', $datamou->jenis_mitra) == 'Perguruan Tinggi Negeri' ? 'selected' : '' }}>Perguruan Tinggi Negeri</option>
                <option value="Perguruan Tinggi Swasta" {{ old('jenis_mitra', $datamou->jenis_mitra) == 'Perguruan Tinggi Swasta' ? 'selected' : '' }}>Perguruan Tinggi Swasta</option>
                <option value="Bank" {{ old('jenis_mitra', $datamou->jenis_mitra) == 'Bank' ? 'selected' : '' }}>Bank</option>
                <option value="Perguruan Tinggi Luar Negeri" {{ old('jenis_mitra', $datamou->jenis_mitra) == 'Perguruan Tinggi Luar Negeri' ? 'selected' : '' }}>Perguruan Tinggi Luar Negeri</option>
            </select>
            @error('jenis_mitra')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputJenisKerjasama" class="form-label"><strong>Jenis Kerjasama:</strong></label>
            <select 
                name="jenis_kerjasama" 
                class="form-select @error('jenis_kerjasama') is-invalid @enderror" 
                id="inputJenisKerjasama">
                <option value="">Pilih Jenis Kerjasama</option>
                <option value="Nota Kesepahaman" {{ old('jenis_kerjasama', $datamou->jenis_kerjasama) == 'Nota Kesepahaman' ? 'selected' : '' }}>Nota Kesepahaman</option>
                <option value="MoU Kerjasama" {{ old('jenis_kerjasama', $datamou->jenis_kerjasama) == 'MoU Kerjasama' ? 'selected' : '' }}>MoU Kerjasama</option>
                <option value="MoU Kesepakatan" {{ old('jenis_kerjasama', $datamou->jenis_kerjasama) == 'MoU Kesepakatan' ? 'selected' : '' }}>MoU Kesepakatan</option>
                <option value="Adendum Perjanjian" {{ old('jenis_kerjasama', $datamou->jenis_kerjasama) == 'Adendum Perjanjian' ? 'selected' : '' }}>Adendum Perjanjian</option>
                <option value="Konsorsium" {{ old('jenis_kerjasama', $datamou->jenis_kerjasama) == 'Konsorsium' ? 'selected' : '' }}>Konsorsium</option>
                <option value="MoU Kesepakatan Terpadu" {{ old('jenis_kerjasama', $datamou->jenis_kerjasama) == 'MoU Kesepakatan Terpadu' ? 'selected' : '' }}>MoU Kesepakatan Terpadu</option>
                <option value="Implementation Agreement" {{ old('jenis_kerjasama', $datamou->jenis_kerjasama) == 'Implementation Agreement' ? 'selected' : '' }}>Implementation Agreement</option>
            </select>
            @error('jenis_kerjasama')
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