<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function store(StoreKriteriaRequest $request)
    {
        Kriteria::create($request->validated());

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function update(StoreKriteriaRequest $request, Kriteria $kriteria)
    {
        $kriteria->update($request->validated());

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui');
    }
}
