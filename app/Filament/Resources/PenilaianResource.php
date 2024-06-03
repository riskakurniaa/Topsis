<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kriteria;
use Filament\Forms\Form;
use App\Models\Penilaian;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PenilaianResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenilaianResource\RelationManagers;

class PenilaianResource extends Resource
{
    protected static ?string $model = Penilaian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Bantuan Sosial';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('alternatif_id')
                    ->relationship('alternatif', 'nama')
                    ->required()
                    ->label('Alternatif'),
                Select::make('kriteria_id')
                    ->relationship('kriteria', 'nama')
                    ->required()
                    ->label('Kriteria')
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('sub_kriteria_id', null);
                    }),
                Select::make('sub_kriteria_id')
                    ->label('Sub Kriteria')
                    ->required()
                    ->options(function (callable $get) {
                        $kriteriaId = $get('kriteria_id');
                        if ($kriteriaId) {
                            $kriteria = Kriteria::find($kriteriaId);
                            if ($kriteria) {
                                return $kriteria->subKriteria()
                                    ->pluck('nilai', 'sub_kriteria_id')
                                    ->toArray();
                            }
                        }
                        return [];
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('alternatif.nama')->label('Alternatif'),
                TextColumn::make('kriteria.nama')->label('Kriteria'),
                TextColumn::make('subKriteria.nilai')->label('Sub Kriteria'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenilaians::route('/'),
            'create' => Pages\CreatePenilaian::route('/create'),
            'edit' => Pages\EditPenilaian::route('/{record}/edit'),
        ];
    }
}
