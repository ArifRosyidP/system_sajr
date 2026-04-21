<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Purchasingorder extends Model
{
    use HasUuids;
    protected $fillable = ['id', 'tanggal_po', 'id_klien', 'id_pekerjaan', 
    'id_subkontraktor','nomor_po', 'pajak', 'id_supplier', 
    'nama_barang', 'kuantitas', 'satuan', 'harga_satuan',
    'jumlah','transportasi','termofpayment','tanggal_pengiriman',
    'id_personincharge', 'tujuan', 'catatan', 'invoice', 
    'tanggal_invoice','no_bukti','status','total_po','totalbayar_co',
    'sisa_status','tanggal_bayar','dp1','pelunasan1','dp2','pelunasan2', 'id_user'];

    public $incrementing = false;
    protected $keyType = 'string';

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_klien');
    }
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan');
    }
    public function subkontraktor()
    {
        return $this->belongsTo(Subkontraktor::class, 'id_subkontraktor');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
    public function personincharge()
    {
        return $this->belongsTo(Personincharge::class, 'id_personincharge');
    }
}
