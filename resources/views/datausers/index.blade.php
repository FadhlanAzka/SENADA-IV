@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data Akun</h5>
                        </div>
                        <a href="{{ route('datausers.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;Data Baru</a>
                    </div>
                </div>

                @if(session('success'))
                    <script>
                        window.onload = function() {
                            alert("Sukses! {{ session('success') }}");
                        }
                    </script>
                @endif

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NAMA
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        EMAIL
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        PRIVILEGE
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ACTION
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $user->privilege == 'Admin' ? 'bg-warning' : 'bg-success' }}">
                                                {{ $user->privilege }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('datausers.edit', $user->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                            <form action="{{ route('datausers.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus pengguna ini?');" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection