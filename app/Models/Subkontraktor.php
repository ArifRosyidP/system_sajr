<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Subkontraktor extends Model
{
    use HasUuids;
    protected $fillable = ['id', 'nama', 'alamat', 'nomor_hp', 'npwp', 'id_user'];
    public $incrementing = false;
    protected $keyType = 'string';
    public function purchasingOrders()
    {
        return $this->hasMany(Purchasingorder::class, 'id_subkontraktor');
    }
    }
