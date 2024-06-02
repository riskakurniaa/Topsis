<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $primaryKey = 'kriteria_id';

    protected $fillable = ['kode', 'nama', 'bobot'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $totalBobot = Kriteria::sum('bobot');
            if ($totalBobot + $model->bobot - ($model->getOriginal('bobot') ?? 0) > 1) {
                throw new \Exception('Total bobot kriteria tidak boleh lebih dari 1.');
            }
        });
    }

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class, 'kriteria_id');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'kriteria_id');
    }
}
