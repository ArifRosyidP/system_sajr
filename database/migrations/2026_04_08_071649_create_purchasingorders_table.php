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
            // $table->id();
            $table->uuid('id')->primary();
            $table->date('tanggal_po');
            $table->foreignUuid('id_klien')->constrained('clients');
            // $table->foreignId('id_pekerjaan')->nullable()->constrained('pekerjaans')->nullOnDelete();
            $table->foreignUuid('id_pekerjaan')->nullable()->constrained('pekerjaans');
            $table->foreignUuid('id_subkontraktor')->nullable()->constrained('subkontraktors');
            $table->string('nomor_po');
            $table->string('pajak')->nullable();
            $table->foreignUuid('id_supplier')->constrained('suppliers');
            $table->string('nama_barang');
            $table->decimal('kuantitas',18,2);
            $table->string('satuan');
            $table->decimal('harga_satuan',18,2);
            $table->decimal('jumlah',18,2);
            $table->decimal('transportasi',18,2)->nullable();
            $table->string('termofpayment');
            $table->date('tanggal_pengiriman');
            $table->foreignUuid('id_personincharge')->constrained('personincharges');
            $table->string('tujuan');
            $table->string('catatan')->nullable();
            $table->string('invoice')->nullable();
            $table->date('tanggal_invoice')->nullable();
            $table->string('no_bukti')->nullable();
            $table->string('status')->nullable();
            $table->decimal('total_po',18,2)->nullable();
            $table->decimal('totalbayar_co',18,2)->nullable();
            $table->string('sisa_status')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->boolean('dp1')->nullable();
            $table->boolean('pelunasan1')->nullable();
            $table->boolean('dp2')->nullable();
            $table->boolean('pelunasan2')->nullable();
            $table->foreignUuid('id_user')->constrained('users');
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
