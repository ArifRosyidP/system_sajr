<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasUuids;
    protected $fillable = ['id', 'nama', 'alamat', 'nomor_hp', 'npwp'];

    public $incrementing = false;
    protected $keyType = 'string';
}
