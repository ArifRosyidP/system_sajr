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
        Schema::create('purchasingorders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->date('tanggal_po');
            $table->foreignId('id_klien')->constrained('clients');
            // $table->foreignId('id_pekerjaan')->nullable()->constrained('pekerjaans')->nullOnDelete();
            $table->foreignId('id_pekerjaan')->nullable()->constrained('pekerjaans');
            $table->foreignId('id_subkontraktor')->nullable()->constrained('subkontraktors');
            $table->string('nomor_po');
            $table->string('pajak')->nullable();
            $table->foreignId('id_suplier')->constrained('supliers');
            $table->string('nama_barang');
            $table->decimal('kuantitas');
            $table->string('satuan');
            $table->decimal('harga_satuan');
            $table->decimal('jumlah');
            $table->decimal('transportasi')->nullable();
            $table->string('termofpayment');
            $table->date('tanggal_pengiriman');
            $table->foreignId('id_personincharge')->constrained('personincharges');
            $table->string('tujuan');
            $table->string('catatan')->nullable();
            $table->string('invoice')->nullable();
            $table->date('tanggal_invoice')->nullable();
            $table->string('no_bukti')->nullable();
            $table->string('status')->nullable();
            $table->decimal('total_po')->nullable();
            $table->decimal('totalbayar_co')->nullable();
            $table->string('sisa_status')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->boolean('dp1')->nullable();
            $table->boolean('pelunasan1')->nullable();
            $table->boolean('dp2')->nullable();
            $table->boolean('pelunasan2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasingorders');
    }
};
