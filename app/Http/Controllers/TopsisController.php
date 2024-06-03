<?php

namespace App\Http\Controllers;

use App\Models\Topsis;
use Illuminate\Http\Request;
use App\Services\TopsisService;

class TopsisController extends Controller
{
    protected $topsisService;

    public function __construct(TopsisService $topsisService)
    {
        $this->topsisService = $topsisService;
    }

    public function calculateAndStore(Request $request)
    {
        // Panggil service untuk melakukan perhitungan TOPSIS
        $hasilTopsis = $this->topsisService->calculateTopsis();

        // Simpan hasil perhitungan ke dalam database
        foreach ($hasilTopsis as $hasil) {
            if (!empty($hasil['alternatif_id'])) {
                Topsis::updateOrCreate(
                    ['alternatif_id' => $hasil['alternatif_id']],
                    ['nilai' => $hasil['nilai']]
                );
            }
        }

        return redirect()->back()->with('success', 'Perhitungan TOPSIS berhasil dilakukan.');
    }
}
