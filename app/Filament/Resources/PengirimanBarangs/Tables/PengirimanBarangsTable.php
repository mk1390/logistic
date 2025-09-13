<?php

namespace App\Filament\Resources\PengirimanBarangs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengirimanBarangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nomor_resi')
                ->label('NO. Resi')
                ->searchable(),
                TextColumn::make('nama_pengirim')
                ->label('PIC Pengirim')
                ->searchable(),
                TextColumn::make('telepon_pengirim')
                ->label('Telepon PIC')
                ->searchable(),
                TextColumn::make('customer.nama_perusahaan')
                ->label('Perusahaan Pengirim')
                ->searchable(),
                TextColumn::make('kotaPenerima.nama_kota')
                ->label('Tujuan')
                ->searchable(),
                TextColumn::make('jenisbarang.jenis_barang')
                ->label('Jenis Barang')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
