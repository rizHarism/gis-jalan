<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuasJalan extends Model
{
    use HasFactory;
    protected $table = 'ruas_jalan';
    protected $fillable = ['nomor_ruas', 'nama_ruas', 'pangkal_ruas', 'ujung_ruas', 'lingkungan', 'kelurahan_id', 'kecamatan_id', 'panjang', 'lebar', 'bahu_kanan', 'bahu_kiri', 'perkerasan_id', 'kondisi_id', 'utilitas', 'start_x', 'start_y', 'middle_x', 'middle_y', 'end_x', 'end_y', 'geometry', 'image'];

    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'id', 'kecamatan_id');
    }
    public function kelurahan()
    {
        return $this->hasOne(Kelurahan::class, 'id', 'kelurahan_id');
    }
    public function kondisi()
    {
        return $this->hasOne(KondisiJalan::class, 'id', 'kondisi_id');
    }
    public function perkerasan()
    {
        return $this->hasOne(Perkerasan::class, 'id', 'perkerasan_id');
    }
}
