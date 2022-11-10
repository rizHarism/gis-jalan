<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuasJalan extends Model
{
    use HasFactory;
    protected $table = 'ruas_jalan';
    protected $fillable = ['nomor_ruas', 'nama_ruas', 'pangkal_ruas', 'ujung_ruas', 'lingkungan', 'kelurahan_id', 'kecamatan_id', 'panjang', 'lebar', 'bahu_jalan', 'perkerasan', 'kondisi', 'utilitas', 'start_x', 'start_y', 'middle_x', 'middle_y', 'end_x', 'end_y', 'geometry', 'image'];
}
