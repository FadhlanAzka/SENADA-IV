@extends('layouts.user_type.auth')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Tambah Data Pengguna</h2>
    <div class="card-body">
    
        <form action="{{ route('datausers.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="inputName" class="form-label"><strong>Nama</strong></label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="inputName" 
                    placeholder="Nama Pengguna">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
  
            <div class="mb-3">
                <label for="inputEmail" class="form-label"><strong>Email:</strong></label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="inputEmail" 
                    placeholder="Email Pengguna">
                @error('email')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputPassword" class="form-label"><strong>Password:</strong></label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="inputPassword" 
                    placeholder="Password">
                @error('password')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputPrivilege" class="form-label"><strong>Privilege:</strong></label>
                <select 
                    name="privilege" 
                    class="form-select @error('privilege') is-invalid @enderror" 
                    id="inputPrivilege">
                    <option value="">Pilih Privilege</option>
                    <option value="Regular">Regular</option>
                    <option value="Elevated">Elevated</option>
                </select>
                @error('privilege')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 d-flex justify-content-between">
                <a class="btn btn-primary" href="{{ route('datausers.index') }}">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
        </form>  
    </div>
</div>
@endsection