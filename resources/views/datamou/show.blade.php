@extends('layouts.user_type.auth')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Rincian MoU</h2>
    <div class="card-body">

        <div class="row">
            <div class="col-12 mb-2">
                <strong>Nama Mitra:</strong><br/>
                {{ $datamou->nama_mitra }}
            </div>
            <div class="col-12 mb-2">
                <strong>Perihal:</strong><br/>
                {{ $datamou->perihal }}
            </div>
            <div class="col-12 mb-2">
                <strong>Tahun:</strong><br/>
                {{ $datamou->tahun }}
            </div>
            <div class="col-12 mb-2">
                <strong>Jenis Mitra:</strong><br/>
                {{ $datamou->jenis_mitra }}
            </div>
            <div class="col-12 mb-2">
                <strong>Jenis Kerjasama:</strong><br/>
                {{ $datamou->jenis_kerjasama }}
            </div>
            <div class="col-12 mb-2">
                <strong>Masa Berlaku (Tahun):</strong><br/>
                {{ $datamou->masa_berlaku_mou_tahun }}
            </div>
            <div class="col-12 mb-2">
                <strong>Mulai Berlaku:</strong><br/>
                {{ $datamou->mulai_berlaku }}
            </div>
            <div class="col-12 mb-2">
                <strong>Tanggal Kadaluarsa:</strong><br/>
                {{ $datamou->tanggal_kadaluarsa }}
            </div>
            <div class="col-12 mb-2">
                <strong>Nomor Agenda Mitra:</strong><br/>
                {{ $datamou->nomor_agenda_mitra }}
            </div>
            <div class="col-12 mb-2">
                <strong>Nomor Agenda LLDIKTI:</strong><br/>
                {{ $datamou->nomor_agenda_lldikti }}
            </div>
            <div class="col-12 mb-2">
                <strong>Status Dokumen:</strong><br/>
                {{ $datamou->status_dokumen }}
            </div>
            <div class="col-12 mb-2">
                <strong>Keterangan Dokumen:</strong><br/>
                {{ $datamou->keterangan_dokumen ?: 'No file attached.' }}
            </div>
            <div class="col-12 mb-2">
                <strong>Dokumen MoU:</strong><br/>
                @if($datamou->link_dokumen)
                    @foreach(explode("\n", $datamou->link_dokumen) as $link)
                        <?php 
                            // Ambil ID dari link
                            preg_match('/\/d\/(.*?)(\/|$)/', trim($link), $matches);
                            $fileId = $matches[1] ?? null;
                        ?>
                        @if($fileId)
                            <iframe src="https://drive.google.com/file/d/{{ $fileId }}/preview" width="480" height="660"></iframe>
                        @else
                            <p>Link tidak valid.</p>
                        @endif
                    @endforeach
                @else
                    No file attached.
                @endif
            </div>
            <div class="col-12 mb-2">
                <strong>Bentuk Tindak Lanjut:</strong><br/>
                {{ $datamou->bentuk_tindak_lanjut ?: 'No file attached.' }}
            </div>
            <div class="col-12 mb-2">
                <strong>Status Kadaluarsa:</strong><br/>
                @if($datamou->status_kadaluarsa == 'Sudah Kadaluarsa')
                    <strong><span class="text-danger">{{ $datamou->status_kadaluarsa }}</span></strong>
                @elseif($datamou->status_kadaluarsa == 'Belum Kadaluarsa')
                    <strong><span class="text-success">{{ $datamou->status_kadaluarsa }}</span></strong>
                @else
                    <strong>{{ $datamou->status_kadaluarsa }}</strong>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a class="btn btn-primary" href="{{ route('datamou.index') }}">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <a class="btn btn-warning" href="{{ route('datamou.edit', $datamou->id) }}">
                <i class="fa fa-edit"></i> Edit
            </a>
            <form action="{{ route('datamou.destroy', $datamou->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection