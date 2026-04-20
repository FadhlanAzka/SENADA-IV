@extends('layouts.user_type.auth')

@section('content')

<style>
    /* Mengecilkan ukuran font tabel */
    .table {
        font-size: 14px;
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    /* Merapatkan padding kolom */
    .table th, .table td {
        padding: 8px;
        text-align: center; /* Pusatkan teks */
        vertical-align: middle; /* Pusatkan secara vertikal */
        white-space: nowrap; /* Agar teks tidak wrap */
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Responsif: tambahkan scroll horizontal */
    .table-responsive {
        overflow-x: auto;
    }

    /* Warna hover pada tabel */
    .table tbody tr:hover {
        background-color: #f0f9f9;
    }

    /* Header tabel lebih bold */
    .table th {
        font-size: 12px;
        font-weight: bold;
        background-color: #f5f5f5;
    }

    /* Membatasi kolom dengan border */
    .table th, .table td {
        border: 1px solid #dee2e6;
    }

    /* Agar tombol dalam kolom aksi tidak terlalu besar */
    .table td .btn {
        padding: 4px 8px;
        font-size: 12px;
    }

    /* Responsif tabel pada perangkat kecil */
    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 12px;
            padding: 6px;
        }
    }

    .modal {
    z-index: 1050; /* Tinggi */
    }
    .modal-backdrop {
        z-index: 1049; /* Di bawah modal */
    }

</style>

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="action-bar">
                        <h5 class="mb-0">Data Kerjasama</h5>

                        <!-- Search Bar -->
                        <form action="{{ route('datamou.index') }}" method="GET">
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control form-control-sm" 
                                placeholder="Cari..." 
                                value="{{ request('search') }}">
                        </form>

                        <!-- Tombol Filter -->
                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">
                            Filter
                        </button>

                        <!-- Tombol Hapus Filter -->
                        @if(request()->has('filtered') && request('filtered'))
                            <a href="{{ route('datamou.index') }}" class="btn btn-sm btn-danger">Hapus Filter</a>
                        @endif

                        <!-- Tambahkan Data Baru -->
                        @unless(auth()->user()->privilege === 'Super Admin')
                            <a href="{{ route('datamou.create') }}" class="btn bg-gradient-primary btn-sm" type="button">
                                +&nbsp;Data Baru
                            </a>
                        @endunless

                        <!-- Tombol Impor Data -->
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                            Impor Data
                        </button>
                        <!-- Tombol Update Data -->
<form action="{{ route('datamou.updateAll') }}" method="POST" style="display: inline;">
    @csrf
    <button class="btn btn-sm btn-warning" type="submit">
        Update Data
    </button>
</form>
                    </div>
                </div>

                @if(session('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            title: 'Sukses!',
                            text: "{{ session('success') }}",
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>
                        <a href="{{ route('datamou.index', ['sort_by' => 'nama_mitra', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}" class="text-secondary">
                            Nama Mitra
                        </a>
                    </th>
                    <th>Perihal</th>
                    <th>Tahun</th>
                    <th>Jenis Mitra</th>
                    <th>Jenis Kerjasama</th>
                    <th>Masa Berlaku (Tahun)</th>
                    <th>Mulai Berlaku</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Status Kerjasama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datamou as $index => $mou)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mou->nama_mitra }}</td>
                        <td>{{ $mou->perihal }}</td>
                        <td>
    @php
        $tahun = null;
        if ($mou->mulai_berlaku) {
            $tahun = \Carbon\Carbon::parse($mou->mulai_berlaku)->year;
        }
    @endphp

    {{ $tahun ?? $mou->tahun }}
</td>

                        <td>{{ $mou->jenis_mitra }}</td>
                        <td>{{ $mou->jenis_kerjasama }}</td>
                        <td>
    @if ($mou->mulai_berlaku && $mou->tanggal_kadaluarsa)
        @php
            $mulaiBerlaku = \Carbon\Carbon::parse($mou->mulai_berlaku);
            $tanggalKadaluarsa = \Carbon\Carbon::parse($mou->tanggal_kadaluarsa);
            $totalBulan = $mulaiBerlaku->diffInMonths($tanggalKadaluarsa) + ($mulaiBerlaku->diffInDays($tanggalKadaluarsa) % 30) / 30;
        @endphp

        @if ($totalBulan >= 12)
            {{ floor($totalBulan / 12) }} Tahun
        @elseif ($totalBulan >= 1)
            {{ floor($totalBulan) }} Bulan
        @elseif ($totalBulan > 0)
            {{ ceil($totalBulan) }} Bulan
        @else
            Tidak Tersedia
        @endif
    @else
        Tidak Tersedia
    @endif
</td>

                        <td>
                            {{ $mou->mulai_berlaku ? $mou->mulai_berlaku->format('d-m-Y') : ' ' }}
                        </td>
                        <td>
                            {{ $mou->tanggal_kadaluarsa ? $mou->tanggal_kadaluarsa->format('d-m-Y') : ' ' }}
                        </td>
                        <td>
    @php
        $today = \Carbon\Carbon::today();
        $expirationDate = \Carbon\Carbon::parse($mou->tanggal_kadaluarsa);

        // Default status
        $status = null;

        if ($mou->tanggal_kadaluarsa) {
            if ($today->gt($expirationDate)) {
                $status = 'Kadaluarsa';
            } elseif ($today->diffInMonths($expirationDate) < 3 && $today->lte($expirationDate)) {
                $status = 'Masa Tenggang';
            } elseif ($today->lte($expirationDate)) {
                $status = 'Aktif';
            }
        }
    @endphp

    @if($status == 'Kadaluarsa')
        <span class="text-danger">{{ $status }}</span>
    @elseif($status == 'Aktif')
        <span class="text-success">{{ $status }}</span>
    @elseif($status == 'Masa Tenggang')
        <span class="text-warning">{{ $status }}</span>
    @else
        <span>{{ $status }}</span>
    @endif
</td>

                        <td>
                            <!-- Tombol View -->
                            <a href="{{ route('datamou.show', $mou->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i>
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('datamou.edit', $mou->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('datamou.destroy', $mou->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

                    <!-- Link Paginate -->
                    <div class="d-flex justify-content-center">
                        {{ $datamou->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('datamou.index') }}" method="GET">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Data Kerjasama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Nama Mitra -->
                    <div class="mb-3">
                        <label for="filterNamaMitra" class="form-label">Nama Mitra</label>
                        <input 
                            type="text" 
                            name="filter_nama_mitra" 
                            id="filterNamaMitra" 
                            class="form-control filter-input" 
                            placeholder="Ketik Nama Mitra">
                    </div>

                    <!-- Tahun -->
                    <div class="mb-3">
                        <label for="filterTahun" class="form-label">Tahun</label>
                        <input 
                            type="number" 
                            name="filter_tahun" 
                            id="filterTahun" 
                            class="form-control filter-input" 
                            placeholder="Masukkan Tahun">
                    </div>

                    <!-- Jenis Mitra -->
                    <div class="mb-3">
                        <label for="filterJenisMitra" class="form-label">Jenis Mitra</label>
                        <select 
                            name="filter_jenis_mitra" 
                            id="filterJenisMitra" 
                            class="form-select filter-input">
                            <option value="">Pilih Jenis Mitra</option>
                            <option value="Dunia Usaha & Dunia Industri">Dunia Usaha & Dunia Industri</option>
                            <option value="Pemerintah Daerah">Pemerintah Daerah</option>
                            <option value="Lembaga Pemerintah Non Pemerintah Daerah">Lembaga Pemerintah Non Pemerintah Daerah</option>
                            <option value="Organisasi Nirlaba">Organisasi Nirlaba</option>
                            <option value="Perguruan Tinggi Negeri">Perguruan Tinggi Negeri</option>
                            <option value="Perguruan Tinggi Swasta">Perguruan Tinggi Swasta</option>
                            <option value="Bank">Bank</option>
                            <option value="Perguruan Tinggi Luar Negeri">Perguruan Tinggi Luar Negeri</option>
                        </select>
                    </div>

                    <!-- Jenis Kerjasama -->
                    <div class="mb-3">
                        <label for="filterJenisKerjasama" class="form-label">Jenis Kerjasama</label>
                        <select 
                            name="filter_jenis_kerjasama" 
                            id="filterJenisKerjasama" 
                            class="form-select filter-input">
                            <option value="">Pilih Jenis Kerjasama</option>
                            <option value="Nota Kesepahaman">Nota Kesepahaman</option>
                            <option value="MoU Kerjasama">MoU Kerjasama</option>
                            <option value="MoU Kesepakatan">MoU Kesepakatan</option>
                            <option value="Adendum Perjanjian">Adendum Perjanjian</option>
                            <option value="Konsorsium">Konsorsium</option>
                            <option value="MoU Kesepakatan Terpadu">MoU Kesepakatan Terpadu</option>
                            <option value="Implementation Agreement">Implementation Agreement</option>
                        </select>
                    </div>

                    <!-- Masa Berlaku MoU -->
                    <div class="mb-3">
                        <label for="filterMasaBerlakuMoU" class="form-label">Masa Berlaku MoU (Tahun)</label>
                        <input 
                            type="number" 
                            name="filter_masa_berlaku_mou_tahun" 
                            id="filterMasaBerlakuMoU" 
                            class="form-control filter-input" 
                            placeholder="Masukkan Masa Berlaku (Tahun)">
                    </div>

                    <!-- Mulai Berlaku -->
                    <div class="mb-3">
                        <label for="filterMulaiBerlaku" class="form-label">Mulai Berlaku</label>
                        <input 
                            type="date" 
                            name="filter_mulai_berlaku" 
                            id="filterMulaiBerlaku" 
                            class="form-control filter-input">
                    </div>

                    <!-- Tanggal Kadaluarsa -->
                    <div class="mb-3">
                        <label for="filterTanggalKadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                        <input 
                            type="date" 
                            name="filter_tanggal_kadaluarsa" 
                            id="filterTanggalKadaluarsa" 
                            class="form-control filter-input">
                    </div>

                    <!-- Status Dokumen -->
                    <div class="mb-3">
                        <label for="filterStatusDokumen" class="form-label">Status Dokumen</label>
                        <select 
                            name="filter_status_dokumen" 
                            id="filterStatusDokumen" 
                            class="form-select filter-input">
                            <option value="">Pilih Status Dokumen</option>
                            <option value="Lengkap">Lengkap</option>
                            <option value="Tidak Lengkap">Tidak Lengkap</option>
                        </select>
                    </div>

                    <!-- Status Kadaluarsa -->
                    <div class="mb-3">
                        <label for="filterStatusKadaluarsa" class="form-label">Status Kadaluarsa</label>
                        <select 
                            name="filter_status_kadaluarsa" 
                            id="filterStatusKadaluarsa" 
                            class="form-select filter-input">
                            <option value="">Pilih Status Kadaluarsa</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Masa Tenggang">Masa Tenggang</option>
                            <option value="Kadaluarsa">Kadaluarsa</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Impor Data -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('datamou.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Impor Data Kerjasama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File Excel/CSV</label>
                        <input type="file" name="file" id="file" class="form-control" accept=".xlsx,.csv" required>
                        <small class="form-text text-muted">Pastikan file mengikuti format template.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Impor</button>
                </div>
            </form>
        </div>
    </div>
</div>


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<!-- Scripts -->
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
    $(function () {
        // Fungsi untuk membuat autocomplete
        function applyAutocomplete(inputId, field) {
            $(inputId).autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('datamou.suggestion') }}",
                        data: {
                            term: request.term,
                            field: field
                        },
                        success: function (data) {
                            response(data); // Kirim data ke autocomplete
                        }
                    });
                },
                minLength: 2, // Minimal input sebelum memunculkan suggestion
            });
        }

        // Terapkan autocomplete ke input filter
        applyAutocomplete("#filterNamaMitra", "nama_mitra");
        applyAutocomplete("#filterJenisMitra", "jenis_mitra");
        applyAutocomplete("#filterJenisKerjasama", "jenis_kerjasama");
        applyAutocomplete("#filterPerihal", "perihal");
        applyAutocomplete("#filterStatusDokumen", "status_dokumen");
    });
</script>
@endpush
@endsection