<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyedia extends Model
{
    use HasFactory;
    protected $table = 'penyedia_jasa';
    protected $fillable = ['nama', 'direktur', 'alamat', 'nib', 'npwp'];
}
