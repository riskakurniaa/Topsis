<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopsisResource\Pages;
use App\Filament\Resources\TopsisResource\RelationManagers;
use App\Models\Topsis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopsisResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Bantuan Sosial';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')->primary(),
                Tables\Columns\TextColumn::make('alternatif_id')->label('Alternatif'),
                Tables\Columns\TextColumn::make('nilai')->label('Nilai Perangkingan'),
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
            'index' => Pages\ListTopses::route('/'),
            // 'create' => Pages\CreateTopsis::route('/create'),
            // 'edit' => Pages\EditTopsis::route('/{record}/edit'),
        ];
    }
}
