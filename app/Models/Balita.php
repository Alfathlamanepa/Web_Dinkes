<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Balita extends Model
{
    use HasFactory;

    protected $table = 'balita';
    protected $primaryKey = 'nik_balita';
    public $timestamps = true;

    protected $fillable = [
        'tgl_lahir',
        'jenis_kelamin',
        'nomor_kk',
        'nik_balita',
        'nama_balita',
        'nama_ortu',
        'nik_ortu',
        'hp_ortu',
        'rt',
        'rw',
        'provinsi',
        'kab_kota',
        'kec',
        'puskesmas',
        'desa_kel',
        'posyandu'
    ];
    
    // Accessor untuk menghitung umur balita realtime
    public function getUmurAttribute()
    {   
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['tgl_lahir'])->diffForHumans(Carbon::now());
    }
}