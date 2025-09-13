<?php

namespace App\Filament\Resources\PengirimanBarangs\Schemas;

use Carbon\Carbon;
use Filament\Support\RawJs;
use Filament\Schemas\Schema;
use App\Models\PengirimanBarang;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;

class PengirimanBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Resi & Tanggal')
                    ->columnSpanFull()
                    ->icon(Heroicon::ListBullet)
                    ->schema([

                        //Resi & tanggal
                        //_________________________________________________________

                        TextInput::make('nomor_resi')
                            ->label('Nomor Resi')
                            ->readOnly()
                            ->default(function () {
                                $last = PengirimanBarang::orderByDesc('id')
                                    ->first();
                                $nextnumber = $last ? intval($last->nomor_resi) + 1 : 1;
                                return str_pad($nextnumber, 8, '0', STR_PAD_LEFT);
                            }),

                        //tanggal Kirim
                        DatePicker::make('tanggal_kirim')
                            ->label('Tanggal Kirim')
                            ->required()
                            ->prefixIcon(Heroicon::Calendar)
                            ->displayFormat('d F Y') // Tampilkan seperti 10 September 2025
                            ->native(false)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $estimasi = $get('tanggal_estimasi_diterima');
                                if ($state && $estimasi) {
                                    $kirimDate = \Carbon\Carbon::parse($state);
                                    $estimasiDate = \Carbon\Carbon::parse($estimasi);

                                    $set('durasi_hari', $kirimDate->diffInDays($estimasiDate));
                                }
                            }),

                        //tanggal estimasi diterima
                        DatePicker::make('tanggal_estimasi_diterima')
                            ->prefixIcon(Heroicon::Calendar)
                            ->label('Tanggal Diterima')
                            ->required()
                            ->displayFormat('d F Y') // Tampilkan seperti 10 September 2025
                            ->native(false)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $kirim = $get('tanggal_kirim');
                                if ($kirim && $state) {
                                    $kirimDate = \Carbon\Carbon::parse($kirim);
                                    $estimasiDate = \Carbon\Carbon::parse($state);

                                    $set('durasi_hari', $kirimDate->diffInDays($estimasiDate));
                                }
                            }),

                        // durasi hari
                        TextInput::make('durasi_hari')
                            ->label('Durasi')
                            ->prefix('Hari')
                            ->readOnly() // supaya user tidak ubah manual
                            ->numeric(),

                        //Layanan
                        Select::make('layanan_id')
                            ->label('Layanan')
                            ->required()
                            ->relationship(name: 'layanan', titleAttribute: 'nama_layanan')
                            ->searchable()
                            ->preload(),

                    ]),
                //FORM PENGIRIM
                //_________________________________________________________
                Section::make('Pengirim')
                    ->icon(Heroicon::ArrowRightEndOnRectangle)
                    ->schema([
                        TextInput::make('nama_pengirim')
                            ->label('Nama Pengirim')
                            ->required(),


                        TextInput::make('telepon_pengirim')
                            ->label('Telepon Pengirim')
                            ->required()
                            ->prefixIcon(Heroicon::Phone)
                            ->numeric(),

                        Select::make('perusahaan_id')
                            ->label('Nama Perusahaan')
                            ->required()
                            ->relationship(name: 'customer', titleAttribute: 'nama_perusahaan')
                            ->searchable()
                            ->preload()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $customer = \App\Models\Customer::find($state);
                                    $set('perusahaan_telp_info', $customer?->perusahaan_telp);
                                    $set('perusahaan_alamat_info', $customer?->alamat_perusahaan);
                                } else {
                                    $set('perusahaan_telp_info', null);
                                    $set('perusahaan_alamat_info', null);
                                }
                            })
                            ->afterStateHydrated(function ($state, callable $set) {
                                if ($state) {
                                    $customer = \App\Models\Customer::find($state);
                                    $set('perusahaan_telp_info', $customer?->perusahaan_telp);
                                    $set('perusahaan_alamat_info', $customer?->alamat_perusahaan);
                                }
                            }),

                        TextInput::make('perusahaan_telp_info')
                            ->label('Telepon Perusahaan')
                            ->prefixIcon(Heroicon::Phone)
                            ->disabled()
                            ->dehydrated(false), // Tidak disimpan ke database

                        Textarea::make('perusahaan_alamat_info')
                            ->label('ALamat Perusahaan')
                            ->disabled()
                            ->dehydrated(false), // Tidak disimpan ke database

                        Select::make('kota_pengirim_id')
                            ->label('Kota / Kabupaten Pengirim')
                            ->required()
                            ->relationship(name: 'kotaPengirim', titleAttribute: 'nama_kota')
                            ->searchable()
                            ->preload()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $kotakabupaten = \App\Models\KotaKabupaten::find($state);
                                    $set('inisial_kota_info', $kotakabupaten?->inisial_kota);
                                } else {
                                    $set('inisial_kota_info', null);
                                }
                            })
                            ->afterStateHydrated(function ($state, callable $set) {
                                if ($state) {
                                    $kotakabupaten = \App\Models\KotaKabupaten::find($state);
                                    $set('inisial_kota_info', $kotakabupaten?->inisial_kota);
                                }
                            }),

                        TextInput::make('inisial_kota_info')
                            ->label('Inisial Kota Pengirim')
                            ->disabled()
                            ->dehydrated(false), // Tidak disimpan ke database
                    ]),

                //FORM PENERIMA
                //_________________________________________________________
                Section::make('Penerima')
                    ->icon(Heroicon::ArrowLeftEndOnRectangle)
                    ->schema([

                        TextInput::make('nama_penerima')
                            ->label('Nama Penerima')
                            ->required(),

                        TextInput::make('telepon_penerima')
                            ->label('Telepon Penerima')
                            ->prefixIcon(Heroicon::Phone)
                            ->required()
                            ->numeric(),

                        Textarea::make('alamat_penerima')
                            ->rows(9)
                            ->label('ALamat Penerima')
                            ->required(),

                        Select::make('kota_penerima_id')
                            ->label('Kota / Kabupaten Penerima')
                            ->required()
                            ->relationship(name: 'kotaPenerima', titleAttribute: 'nama_kota')
                            ->searchable()
                            ->preload()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $kotakabupaten = \App\Models\KotaKabupaten::find($state);
                                    $set('inisial_kota_info2', $kotakabupaten?->inisial_kota);
                                } else {
                                    $set('inisial_kota_info2', null);
                                }
                            })
                            ->afterStateHydrated(function ($state, callable $set) {
                                if ($state) {
                                    $kotakabupaten = \App\Models\KotaKabupaten::find($state);
                                    $set('inisial_kota_info2', $kotakabupaten?->inisial_kota);
                                }
                            }),

                        TextInput::make('inisial_kota_info2')
                            ->label('Inisial Kota Penerima')
                            ->disabled()
                            ->dehydrated(false), // Tidak disimpan ke database

                    ]),


                //FORM BARANG
                //_________________________________________________________

                Section::make('Detail Barang')
                    ->icon(Heroicon::ArchiveBox)
                    ->columnSpanFull()
                    ->schema([

                        TextInput::make('nama_barang')
                            ->label('Nama Barang')
                            ->required(),

                        Select::make('jenis_barang_id')
                            ->label('Jenis Barang')
                            ->required()
                            ->relationship(name: 'jenisbarang', titleAttribute: 'jenis_barang')
                            ->searchable()
                            ->preload(),

                        Select::make('pelindung_barang_id')
                            ->label('Pelindung Barang')
                            ->required()
                            ->relationship(name: 'pelindungbarang', titleAttribute: 'pelindung_barang')
                            ->searchable()
                            ->preload(),

                        TextInput::make('jumlah_koli')
                            ->label('Jumlah Koli')
                            ->required()
                            ->prefixIcon(Heroicon::ArchiveBoxArrowDown)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric(),

                        TextInput::make('berat_kg')
                            ->required()
                            ->label('Berat')
                            ->prefix('Kg')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric(),
                    ]),

                Section::make('Harga')
                    ->icon(Heroicon::Banknotes)
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([

                        TextInput::make('harga_kirim')
                            ->label('Harga Kirim')
                            ->prefix('Rp')
                            /* ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',') */
                            ->numeric()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $clean = fn($value) => (float) str_replace(',', '', $value);

                                $set(
                                    'total_harga',
                                    $clean($get('harga_kirim')) +
                                        $clean($get('harga_asuransi')) +
                                        $clean($get('harga_bongkar')) +
                                        $clean($get('harga_lainnya'))
                                );
                            }),

                        Placeholder::make('harga_kirim_info')
                            ->label('Harga Kirim')
                            ->content(
                                fn(callable $get) =>
                                'Rp ' . (
                                    $get('harga_kirim')
                                    ? number_format((float) str_replace(',', '', $get('harga_kirim')), 0, '.', ',')
                                    : '0'
                                )
                            )
                            ->columnSpan(1)
                            ->dehydrated(false),


                        TextInput::make('harga_asuransi')
                            ->label('Harga Asuransi')
                            ->prefix('Rp')
                            /*  ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',') */
                            ->numeric()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $clean = fn($value) => (float) str_replace(',', '', $value);

                                $set(
                                    'total_harga',
                                    $clean($get('harga_kirim')) +
                                        $clean($get('harga_asuransi')) +
                                        $clean($get('harga_bongkar')) +
                                        $clean($get('harga_lainnya'))
                                );
                            }),


                        Placeholder::make('harga_asuransi_info')
                            ->label('Harga Asuransi')
                            ->content(
                                fn(callable $get) =>
                                'Rp ' . (
                                    $get('harga_asuransi')
                                    ? number_format((float) str_replace(',', '', $get('harga_asuransi')), 0, '.', ',')
                                    : '0'
                                )
                            )
                            ->columnSpan(1)
                            ->dehydrated(false),



                        TextInput::make('harga_bongkar')
                            ->label('Harga Bongkar')
                            ->prefix('Rp')
                            /* ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',') */
                            ->numeric()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $clean = fn($value) => (float) str_replace(',', '', $value);

                                $set(
                                    'total_harga',
                                    $clean($get('harga_kirim')) +
                                        $clean($get('harga_asuransi')) +
                                        $clean($get('harga_bongkar')) +
                                        $clean($get('harga_lainnya'))
                                );
                            }),


                        Placeholder::make('harga_bongkar_info')
                            ->label('Harga Bongkar')
                            ->content(
                                fn(callable $get) =>
                                'Rp ' . (
                                    $get('harga_bongkar')
                                    ? number_format((float) str_replace(',', '', $get('harga_bongkar')), 0, '.', ',')
                                    : '0'
                                )
                            )
                            ->columnSpan(1)
                            ->dehydrated(false),



                        TextInput::make('harga_lainnya')
                            ->label('Harga Lainnya')
                            ->prefix('Rp')
                            /* ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',') */
                            ->numeric()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $clean = fn($value) => (float) str_replace(',', '', $value);

                                $set(
                                    'total_harga',
                                    $clean($get('harga_kirim')) +
                                        $clean($get('harga_asuransi')) +
                                        $clean($get('harga_bongkar')) +
                                        $clean($get('harga_lainnya'))
                                );
                            }),


                        Placeholder::make('harga_lainnya_info')
                            ->label('Harga lainnya')
                            ->content(
                                fn(callable $get) =>
                                'Rp ' . (
                                    $get('harga_lainnya')
                                    ? number_format((float) str_replace(',', '', $get('harga_lainnya')), 0, '.', ',')
                                    : '0'
                                )
                            )
                            ->columnSpan(1)
                            ->dehydrated(false),



                        TextInput::make('total_harga')
                            ->label('Total Harga')
                            ->numeric()
                            ->prefix('Rp')
                            /* ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',') */
                            ->disabled()
                            ->dehydrated(),

                        Placeholder::make('total_harga_info')
                            ->label('Total Harga')
                            ->content(
                                fn(callable $get) =>
                                'Rp ' . (
                                    $get('total_harga')
                                    ? number_format((float) str_replace(',', '', $get('total_harga')), 0, '.', ',')
                                    : '0'
                                )
                            )
                            ->columnSpan(1)
                            ->dehydrated(false),




                    ]),


                repeater::make('pengirimanAgents')
                    ->relationship('pengirimanAgents')
                    ->schema([
                        Select::make('agent_id')
                            ->label('Pilih Agent')
                            ->relationship('agent', 'nama_agent')
                            ->searchable()
                            ->required()
                            ->preload(),
                    ])
                    ->label('Daftar Agent')
                    ->columnSpanFull()
                    ->columns(2),

                Section::make('Keterangan')
                    ->icon(Heroicon::Document)
                    ->columnSpanFull()
                    ->schema([

                        Textarea::make('keterangan')
                            ->rows(5),

                    ]),


            ]);
    }
}
