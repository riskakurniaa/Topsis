<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topsis extends Model
{
    use HasFactory;

    protected $table = 'hasil_solusi_topsis';

    protected $fillable = [
        'alternatif_id',
        'nilai',
    ];
}
