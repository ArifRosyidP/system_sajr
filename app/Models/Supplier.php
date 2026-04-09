<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasUuids;
    protected $fillable = ['id', 'nama_perusahaan', 'nama_pemilik', 'alamat', 'nomor_hp', 'npwp'];
    public $incrementing = false;
    protected $keyType = 'string';
}
