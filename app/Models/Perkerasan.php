<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkerasan extends Model
{
    use HasFactory;
    protected $table = 'perkerasan';
    protected $fillable = ['perkerasan'];
}
