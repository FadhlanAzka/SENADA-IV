@extends('layouts.user_type.auth')

@section('content')
<div class="card mt-5">
  <h2 class="card-header">Edit User Data</h2>
  <div class="card-body">
  
    <form action="{{ route('datausers.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="inputName" class="form-label"><strong>Name</strong></label>
            <input 
                type="text" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                id="inputName" 
                value="{{ old('name', $user->name) }}" 
                placeholder="Name">
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
                value="{{ old('email', $user->email) }}" 
                placeholder="Email">
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
                placeholder="Leave blank to keep current password">
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
                <option value="">Select Privilege</option>
                <option value="Admin" {{ old('privilege', $user->privilege) == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Super Admin" {{ old('privilege', $user->privilege) == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
            </select>
            @error('privilege')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </form>
  
  </div>
</div>
@endsection
