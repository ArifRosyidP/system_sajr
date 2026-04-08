<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchasingorder extends Model
{
    protected $fillable = ['uuid', 
    'tanggal_po', 'id_klien', 'id_pekerjaan', 
    'id_subkontraktor','nomor_po', 'pajak', 'id_supplier', 
    'nama_barang', 'kuantitas', 'satuan', 'harga_satuan',
    'jumlah','transportasi','termofpayment','tanggal_pengiriman',
    'id_personincharge', 'tujuan', 'catatan', 'invoice', 
    'tanggal_invoice','no_bukti','status','total_po','totalbayar_co',
    'sisa_status','tanggal_bayar','dp1','pelunasan1','dp2','pelunasan2'];
}
