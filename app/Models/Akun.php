<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tentukan nama tabel yang digunakan
    protected $table = 'dataakun';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'email',
        'nama',
        'username',
        'password',
        'role',
        'terakhir_login',
        'tanggal_dibuat',
    ];

    // Sembunyikan kolom tertentu saat data model dikembalikan sebagai array atau JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tentukan jenis atribut kolom yang memerlukan casting
    protected $casts = [
        'terakhir_login' => 'datetime',
        'tanggal_dibuat' => 'datetime',
    ];
}