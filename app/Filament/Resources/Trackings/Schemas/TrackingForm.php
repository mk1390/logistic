<?php

namespace App\Filament\Resources\Trackings\Schemas;

use Carbon\Carbon;
use Filament\Schemas\Schema;
use App\Models\PengirimanBarang;
use function Laravel\Prompts\select;

use Monolog\Handler\SamplingHandler;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Placeholder;

class TrackingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Tracking')

                    ->schema([
                        Select::make('pengiriman_barang_id')
                            ->label('Nomor Resi')
                            ->relationship('pengirimanBarang', 'nomor_resi')
                            ->required()
                            ->preload()
                            ->reactive(),

                        Select::make('nama_status')
                            ->label('Nama Status')
                            ->options([
                                'Pckup' => 'Pickup',
                                'Dkirim' => 'Dikirim',
                                'Tansit' => 'Transit',
                                'Sampai di tujuan' => 'Sampai di Tujuan',
                                'Gagal Kirim' => 'Gagal Kirim',
                            ])
                            ->required(),

                    ]),

                Section::make('Informasi data pengiriman')
                    ->schema([
                        Placeholder::make('nama_pengirim')
                            ->label('Nama Pengirim')
                            ->columnSpan(1)
                            ->content(function (callable $get) {
                                $id = $get('pengiriman_barang_id');
                                $pengiriman = PengirimanBarang::find($id);
                                return $pengiriman?->nama_penerima ?? '-';
                            })
                            ->columnSpan(1)
                            ->reactive(),

                        Placeholder::make('perusahaan_id')
                            ->label('Nama Perusahaan')
                            ->columnSpan(1)
                            ->content(function (callable $get) {
                                $id = $get('pengiriman_barang_id');
                                $pengiriman = PengirimanBarang::with('customer')->find($id);
                                return $pengiriman?->customer?->nama_perusahaan ?? '-';
                            })
                            ->columnSpan(1)
                            ->reactive(),

                        Placeholder::make('alamat_penerima')
                            ->label('Alamat Penerima')
                            ->content(function (callable $get) {
                                $id = $get('pengiriman_barang_id');
                                $pengiriman = PengirimanBarang::find($id);
                                return $pengiriman?->alamat_penerima ?? '-';
                            })
                            ->reactive(),


                        Placeholder::make('nama_agen_pengirim')
                            ->label('Nama Agen Pengirim')
                            ->content(function (callable $get) {
                                $id = $get('pengiriman_barang_id');

                                $pengiriman = PengirimanBarang::with('pengirimanAgents.agent')->find($id);

                                return $pengiriman?->pengirimanAgents
                                    ->map(fn($pengirimanAgent) => $pengirimanAgent->agent?->nama_agent)
                                    ->filter()
                                    ->join(', ') ?? '-';
                            })
                            ->reactive()
                            ->columnSpan(1),

                        Placeholder::make('nama_barang')
                            ->label('Nama Barang')
                            ->columnSpan(1)
                            ->content(function (callable $get) {
                                $id = $get('pengiriman_barang_id');
                                $pengiriman = PengirimanBarang::find($id);
                                return $pengiriman?->nama_barang ?? '-';
                            })
                            ->columnSpan(1)
                            ->reactive(),

                        Placeholder::make('tanggal_kirim')
                            ->label('tanggal Kirim')
                            ->columnSpan(1)
                            ->content(function (callable $get) {
                                $id = $get('pengiriman_barang_id');
                                $pengiriman = PengirimanBarang::find($id);
                                return $pengiriman?->tanggal_kirim ?? '-';
                            })
                            ->columnSpan(1)
                            ->reactive(),

                        placeholder::make('tanggal_estimasi_diterima')
                            ->label('Tanggal Estimasi Diterima')
                            ->content(function (callable $get) {
                                $id = $get('pengiriman_barang_id');
                                $pengiriman = \App\Models\PengirimanBarang::find($id);

                                $tanggal = $pengiriman?->tanggal_estimasi_diterima;

                                if (!$tanggal) {
                                    return '-';
                                }

                                return $tanggal instanceof Carbon
                                    ? $tanggal->format('d M Y') // contoh: 15 Sep 2025
                                    : Carbon::parse($tanggal)->format('d M Y');
                            })
                            ->reactive()
                            ->columnSpan(1),



                    ]),


                Select::make('tracking_status_id')
                    ->label('Status Pengiriman')
                    ->relationship('trackingStatus', 'nama_status_tracking')
                    ->required(),

            ]);
    }
}
