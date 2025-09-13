<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengiriman_barangs', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_resi', 8)->unique();
            $table->date('tanggal_kirim');
            $table->date('tanggal_estimasi_diterima')->nullable();
            $table->integer('durasi_hari')->nullable();
            $table->foreignId('layanan_id')->constrained('layanans');


            // Pengirim
            $table->string('nama_pengirim');
            $table->string('telepon_pengirim');
            $table->foreignId('perusahaan_id')->constrained('customers');
            $table->foreignId('kota_pengirim_id')->constrained('kota_kabupatens');

            // Penerima
            $table->string('nama_penerima');
            $table->string('telepon_penerima');
            $table->text('alamat_penerima');
            $table->foreignId('kota_penerima_id')->constrained('kota_kabupatens');

            // Barang    
            $table->string('nama_barang')->nullable();
            $table->foreignId('jenis_barang_id')->constrained('jenis_barangs');
            $table->foreignId('pelindung_barang_id')->constrained('pelindung_barangs');
            $table->integer('jumlah_koli');
            $table->decimal('berat_kg', 8, 2);

            // Harga
            $table->decimal('harga_kirim', 15, 2)->nullable();
            $table->decimal('harga_asuransi', 15, 2)->nullable();
            $table->decimal('harga_bongkar', 15, 2)->nullable();
            $table->decimal('harga_pasang', 15, 2)->nullable();
            $table->decimal('harga_lainnya', 15, 2)->nullable();
            $table->decimal('total_harga', 15, 2)->nullable();

            // Lainnya
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_barangs');
    }
};
