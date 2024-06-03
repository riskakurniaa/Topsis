<?php

namespace App\Filament\Resources\TopsisResource\Pages;

use App\Filament\Resources\TopsisResource;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Http;

class ListTopses extends ListRecords
{
    protected static string $resource = TopsisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('calculateTopsis')
                ->label('Calculate Topsis')
                ->action('calculateTopsis'),
        ];
    }

    public function calculateTopsis()
    {
        // Kirim permintaan POST ke controller Laravel menggunakan fetch
        $response = Http::post(route('filament.calculate-topsis'));

        if ($response->successful()) {
            $this->notify('success', 'Perhitungan TOPSIS berhasil dilakukan.');
        } else {
            $this->notify('danger', 'Terjadi kesalahan saat melakukan perhitungan TOPSIS.');
        }
    }
}
