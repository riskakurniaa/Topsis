<?php

namespace App\Models;

use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKriteria extends Model
{
    use HasFactory;

    protected $primaryKey = 'sub_kriteria_id';

    protected $fillable = ['nama', 'nilai', 'kriteria_id'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'sub_kriteria_id');
    }
}
