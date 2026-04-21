<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasUuids;
    protected $fillable = ['id', 'nama_pekerjaan', 'kode', 'id_klien', 'id_user'];
    public $incrementing = false;
    protected $keyType = 'string';
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_klien');
    }

    public function purchasingOrders()
    {
        return $this->hasMany(Purchasingorder::class, 'id_pekerjaan');
    }
}
