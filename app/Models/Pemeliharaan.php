<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    use HasFactory;
    protected $table = 'pemeliharaan';
    protected $fillable = ['pelaksanaan', 'penyedia_jasa_id', 'biaya', 'ruas_id', 'npwp'];

    function penyedia()
    {
        return $this->hasOne(Penyedia::class, 'id', 'penyedia_jasa_id');
    }
}
