@extends('layouts.user_type.auth')

@section('content')

<style>
    /* Tambahkan CSS untuk efek hover */
    .table tbody tr:hover {
        background-color: #f1f1f1; /* Warna latar belakang saat di-hover */
    }

    /* Jarak antar baris */
    .table tbody tr td {
        padding: 19px; /* Sesuaikan angka sesuai kebutuhan */
    }

    /* Untuk jarak antar baris secara keseluruhan, bisa menggunakan border-spacing pada tabel */
    .table {
        border-spacing: 0 10px; /* Sesuaikan angka sesuai kebutuhan */
    }

    /* Atur lebar tetap tabel */
    .table-fixed {
        table-layout: fixed;
        width: 100%;
    }

    /* Lebar tetap untuk masing-masing kolom */
    .table th, .table td {
        width: 33.33%; /* Atur lebar kolom berdasarkan jumlah kolom, contoh 3 kolom = 33.33% */
        min-width: 150px; /* Set lebar minimum */
        max-width: 250px; /* Set lebar maksimum */
        white-space: nowrap; /* Mencegah teks membungkus ke baris baru */
        overflow: hidden; /* Menyembunyikan teks yang terlalu panjang */
        text-overflow: ellipsis; /* Menampilkan ellipsis (...) jika teks terlalu panjang */
    }

    /* Responsive table agar bisa di-scroll jika terlalu lebar */
    .table-responsive {
        overflow-x: auto;
    }
</style>

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data MoU</h5>
                        </div>
                        <a href="{{ route('datamou.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;Data Baru</a>
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
                <div class="table-responsive p-0">
                    <table class="table table-fixed align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    <a href="{{ route('datamou.index', ['sort_by' => 'nama_mitra', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}" class="text-secondary">
                                        NAMA MITRA
                                    </a>
                                </th>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-md-table-cell">
                                    PERIHAL
                                </th>
                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none d-md-table-cell">
                                    <a href="{{ route('datamou.index', ['sort_by' => 'status_kadaluarsa', 'order' => request('order') == 'asc' ? 'desc' : 'asc', 'status_filter' => request('status_filter') == 'belum_kadaluarsa' ? 'sudah_kadaluarsa' : 'belum_kadaluarsa']) }}" 
                                       class="status-header {{ request('status_filter') == 'belum_kadaluarsa' ? 'belum-kadaluarsa' : (request('status_filter') == 'sudah_kadaluarsa' ? 'sudah-kadaluarsa' : '') }}">
                                        STATUS KADALUARSA
                                    </a>
                                    <!--@if(request('sort_by') == 'status_kadaluarsa')
                                        @if(request('order') == 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    @endif-->
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datamou as $mou)
                                <tr onclick="window.location='{{ route('datamou.show', $mou->id) }}'" style="cursor: pointer;">
                                    <td class="text-left">{{ $mou->nama_mitra }}</td>
                                    <td class="text-left d-none d-md-table-cell">{{ $mou->perihal }}</td>
                                    <td class="text-left d-none d-md-table-cell">
                                        @if($mou->status_kadaluarsa == 'Sudah Kadaluarsa')
                                            <span class="text-danger">{{ $mou->status_kadaluarsa }}</span>
                                        @elseif($mou->status_kadaluarsa == 'Belum Kadaluarsa')
                                            <span class="text-success">{{ $mou->status_kadaluarsa }}</span>
                                        @else
                                            <span>{{ $mou->status_kadaluarsa }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
@endsection