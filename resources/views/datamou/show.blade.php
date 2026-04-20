@extends('layouts.user_type.auth')

@section('content')
<style>
    .text-wrap {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
</style>

<div class="card mt-1">
    <h2 class="card-header">Rincian MoU</h2>
    <div class="card-body">

        <!-- Tabel untuk Desktop -->
        <div class="d-none d-md-block">
    <table class="table table-striped">
        <tbody>
            <tr>
                <th>Nama Mitra</th>
                <td>{{ $datamou->nama_mitra }}</td>
            </tr>
            <tr>
                <th>Perihal</th>
                <td>{{ $datamou->perihal }}</td>
            </tr>
            <tr>
                <th>Tahun</th>
                <td>{{ $datamou->tahun }}</td>
            </tr>
            <tr>
                <th>Jenis Mitra</th>
                <td>{{ $datamou->jenis_mitra }}</td>
            </tr>
            <tr>
                <th>Jenis Kerjasama</th>
                <td>{{ $datamou->jenis_kerjasama }}</td>
            </tr>
            <tr>
                <th>Masa Berlaku</th>
                <td>@if ($datamou->mulai_berlaku && $datamou->tanggal_kadaluarsa)
            @php
                $mulaiBerlaku = \Carbon\Carbon::parse($datamou->mulai_berlaku);
                $tanggalKadaluarsa = \Carbon\Carbon::parse($datamou->tanggal_kadaluarsa);
                $totalBulan = $mulaiBerlaku->diffInMonths($tanggalKadaluarsa) + ($mulaiBerlaku->diffInDays($tanggalKadaluarsa) % 30) / 30;
            @endphp

            @if ($totalBulan >= 12)
                {{ floor($totalBulan / 12) }} Tahun
            @elseif ($totalBulan >= 1)
                {{ floor($totalBulan) }} Bulan
            @else
                Kurang dari 1 Bulan
            @endif
        @else
            Tidak Tersedia
        @endif</td>
            </tr>
            <tr>
                <th>Mulai Berlaku</th>
                <td>{{ $datamou->mulai_berlaku ? \Carbon\Carbon::parse($datamou->mulai_berlaku)->format('d/m/Y') : '' }}</td>
            </tr>
            <tr>
                <th>Tanggal Kadaluarsa</th>
                <td>{{ $datamou->tanggal_kadaluarsa ? \Carbon\Carbon::parse($datamou->tanggal_kadaluarsa)->format('d/m/Y') : '' }}</td>
            </tr>
            <tr>
                <th>Nomor Agenda Mitra</th>
                <td>{{ $datamou->nomor_agenda_mitra }}</td>
            </tr>
                    <tr>
                        <th>Nomor Agenda LLDIKTI</th>
                        <td>{{ $datamou->nomor_agenda_lldikti }}</td>
                    </tr>
                    <tr>
                        <th>Status Dokumen</th>
                        <td>{{ $datamou->status_dokumen }}</td>
                    </tr>
                    <tr>
    <th>Keterangan Dokumen</th>
    <td>{!! nl2br(e($datamou->keterangan_dokumen)) ?: '-' !!}</td>
</tr>
                    <tr>
                        <th>Dokumen MoU</th>
                        <td>
                            @if($datamou->link_dokumen)
                                @foreach(explode("\n", $datamou->link_dokumen) as $link)
                                    <?php 
                                        preg_match('/\/d\/(.*?)(\/|$)/', trim($link), $matches);
                                        $fileId = $matches[1] ?? null;
                                    ?>
                                    @if($fileId)
                                        <div class="embed-responsive">
                                            <iframe src="https://drive.google.com/file/d/{{ $fileId }}/preview" width="480" height="660"></iframe>
                                        </div>
                                    @else
                                        <p>Link tidak valid.</p>
                                    @endif
                                @endforeach
                            @else
                                Berkas Tidak Ada
                            @endif
                        </td>
                    </tr>
                    <tr>
    <th>Bentuk Tindak Lanjut</th>
    <td class="text-wrap">{!! nl2br(e($datamou->bentuk_tindak_lanjut)) ?: '-' !!}</td>
</tr>
                    <tr>
                        <th>Status Kadaluarsa</th>
                        <td>
                            @if($datamou->status_kadaluarsa == 'Kadaluarsa')
                                <strong><span class="text-danger">{{ $datamou->status_kadaluarsa }}</span></strong>
                            @elseif($datamou->status_kadaluarsa == 'Aktif')
                                <strong><span class="text-success">{{ $datamou->status_kadaluarsa }}</span></strong>
                            @elseif($datamou->status_kadaluarsa == 'Masa Tenggang')
                                <strong><span class="text-warning">{{ $datamou->status_kadaluarsa }}</span></strong>
                            @else
                                <strong>{{ $datamou->status_kadaluarsa }}</strong>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Terakhir diubah</th>
                        <td>{{ \Carbon\Carbon::parse($datamou->updated_at)->format('d/m/Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tampilan Kolom untuk Mobile -->
        <div class="d-md-none">
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
            <strong>Masa Berlaku:</strong><br/>
            {{ $datamou->masa_berlaku_mou_tahun }} Tahun
        </div>
        <div class="col-12 mb-2">
            <strong>Mulai Berlaku:</strong><br/>
            {{ $datamou->mulai_berlaku ? \Carbon\Carbon::parse($datamou->mulai_berlaku)->format('d/m/Y') : '' }}
        </div>
        <div class="col-12 mb-2">
            <strong>Tanggal Kadaluarsa:</strong><br/>
            {{ $datamou->tanggal_kadaluarsa ? \Carbon\Carbon::parse($datamou->tanggal_kadaluarsa)->format('d/m/Y') : '' }}
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
                    {{ $datamou->keterangan_dokumen ?: '-' }}
                </div>
                <div class="col-12 mb-2">
                    <strong>Dokumen MoU:</strong><br/>
                    @if($datamou->link_dokumen)
                        @foreach(explode("\n", $datamou->link_dokumen) as $link)
                            <?php 
                                preg_match('/\/d\/(.*?)(\/|$)/', trim($link), $matches);
                                $fileId = $matches[1] ?? null;
                            ?>
                            @if($fileId)
                                <div class="embed-responsive">
                                    <iframe src="https://drive.google.com/file/d/{{ $fileId }}/preview" width="265" height="365"></iframe>
                                </div>
                            @else
                                <p>Link tidak valid.</p>
                            @endif
                        @endforeach
                    @else
                        Berkas Tidak Ada
                    @endif
                </div>
                <div class="col-12 mb-2">
                    <strong>Bentuk Tindak Lanjut:</strong><br/>
                    <div class="text-wrap">{{ $datamou->bentuk_tindak_lanjut ?: '-' }}</div>
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
