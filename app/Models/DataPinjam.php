<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DataPinjam extends Model
{
    protected $table = 'data_pinjam';
    protected $fillable = [
        'kelas',
        'nama_barang',
        'kode_barang',
        'pelajaran',
        'nama_guru',
        'status',
    ];
}
