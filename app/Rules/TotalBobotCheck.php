<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Kriteria;

class TotalBobotCheck implements Rule
{
    private $currentBobot;

    public function __construct($currentBobot = 0)
    {
        $this->currentBobot = $currentBobot;
    }

    public function passes($attribute, $value)
    {
        $totalBobot = Kriteria::sum('bobot') - $this->currentBobot;
        return ($totalBobot + $value) <= 1;
    }

    public function message()
    {
        return 'Total bobot kriteria tidak boleh lebih dari 1.';
    }
}
