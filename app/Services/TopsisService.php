<?php

namespace App\Services;

use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Alternatif;
use Illuminate\Support\Collection;

class TopsisService
{
    public function calculateTopsis()
    {
        // Ambil semua data penilaian
        $penilaians = Penilaian::all();

        // Lakukan perhitungan TOPSIS
        // 1. Normalisasi matriks keputusan
        $normalisasiMatriks = $this->normalisasiMatriks($penilaians);

        // 2. Normalisasi matriks bobot keputusan
        $normalisasiBobotMatriks = $this->normalisasiBobotMatriks($normalisasiMatriks);

        // 3. Menghitung matriks solusi ideal positif dan negatif
        $solusiIdealPositif = $this->matriksSolusiIdeal($normalisasiBobotMatriks, 'max');
        $solusiIdealNegatif = $this->matriksSolusiIdeal($normalisasiBobotMatriks, 'min');

        // 4. Menghitung jarak relatif terhadap solusi ideal positif dan negatif
        $jarakRelatifPositif = $this->jarakRelatif($normalisasiBobotMatriks, $solusiIdealPositif);
        $jarakRelatifNegatif = $this->jarakRelatif($normalisasiBobotMatriks, $solusiIdealNegatif);

        // 5. Menghitung nilai perangkingan
        $nilaiPerangkingan = $this->nilaiPerangkingan($jarakRelatifPositif, $jarakRelatifNegatif);

        // Simpan hasil perhitungan ke dalam model atau tempat penyimpanan yang sesuai
    }

    protected function normalisasiMatriks(Collection $penilaians): Collection
    {
        $normalisasiMatriks = collect([]);

        // Lakukan normalisasi untuk setiap kriteria
        $kriteriaIds = $penilaians->pluck('kriteria_id')->unique();
        foreach ($kriteriaIds as $kriteriaId) {
            $penilaianKriteria = $penilaians->where('kriteria_id', $kriteriaId)->pluck('nilai');
            $min = $penilaianKriteria->min();
            $max = $penilaianKriteria->max();

            foreach ($penilaians as $penilaian) {
                $nilai = $penilaian->nilai;
                if ($min != $max) {
                    $normalisasi = ($nilai - $min) / ($max - $min);
                } else {
                    $normalisasi = 0;
                }

                $normalisasiMatriks->push([
                    'penilaian_id' => $penilaian->penilaian_id,
                    'nilai' => $normalisasi,
                ]);
            }
        }

        return $normalisasiMatriks;
    }

    protected function normalisasiBobotMatriks(Collection $normalisasiMatriks): Collection
    {
        $normalisasiBobotMatriks = collect([]);

        // Ambil bobot setiap kriteria
        $kriteriaIds = $normalisasiMatriks->pluck('kriteria_id')->unique();
        foreach ($kriteriaIds as $kriteriaId) {
            $bobotKriteria = Kriteria::find($kriteriaId)->bobot;
            $normalisasiKriteria = $normalisasiMatriks->where('kriteria_id', $kriteriaId);

            foreach ($normalisasiKriteria as $item) {
                $normalisasiBobot = $item['nilai'] * $bobotKriteria;
                $normalisasiBobotMatriks->push([
                    'penilaian_id' => $item['penilaian_id'],
                    'nilai' => $normalisasiBobot,
                ]);
            }
        }

        return $normalisasiBobotMatriks;
    }

    protected function matriksSolusiIdeal(Collection $matriks, $type = 'max'): Collection
    {
        $solusiIdeal = collect([]);

        $kriteriaIds = $matriks->pluck('kriteria_id')->unique();
        foreach ($kriteriaIds as $kriteriaId) {
            $penilaianKriteria = $matriks->where('kriteria_id', $kriteriaId)->pluck('nilai');
            $solusi = ($type === 'max') ? $penilaianKriteria->max() : $penilaianKriteria->min();

            foreach ($penilaianKriteria as $nilai) {
                $solusiIdeal->push([
                    'kriteria_id' => $kriteriaId,
                    'nilai' => $solusi,
                ]);
            }
        }

        return $solusiIdeal;
    }

    protected function jarakRelatif(Collection $matriks, Collection $solusiIdeal): Collection
    {
        $jarakRelatif = collect([]);

        $kriteriaIds = $matriks->pluck('kriteria_id')->unique();
        foreach ($kriteriaIds as $kriteriaId) {
            $penilaianKriteria = $matriks->where('kriteria_id', $kriteriaId)->pluck('nilai');
            $solusiKriteria = $solusiIdeal->where('kriteria_id', $kriteriaId)->first()['nilai'];

            foreach ($penilaianKriteria as $nilai) {
                $jarak = sqrt(pow($nilai - $solusiKriteria, 2));
                $jarakRelatif->push([
                    'kriteria_id' => $kriteriaId,
                    'nilai' => $nilai,
                    'jarak' => $jarak,
                ]);
            }
        }

        return $jarakRelatif;
    }

    protected function nilaiPerangkingan(Collection $jarakRelatifPositif, Collection $jarakRelatifNegatif): Collection
    {
        $nilaiPerangkingan = collect([]);

        $alternatifIds = $jarakRelatifPositif->pluck('alternatif_id')->unique();
        foreach ($alternatifIds as $alternatifId) {
            $jarakPositif = $jarakRelatifPositif->where('alternatif_id', $alternatifId)->sum('jarak');
            $jarakNegatif = $jarakRelatifNegatif->where('alternatif_id', $alternatifId)->sum('jarak');
            $nilaiPerangkingan->push([
                'alternatif_id' => $alternatifId,
                'nilai' => $jarakNegatif / ($jarakNegatif + $jarakPositif),
            ]);
        }

        return $nilaiPerangkingan;
    }
}
