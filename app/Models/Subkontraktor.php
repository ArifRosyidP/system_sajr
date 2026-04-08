<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subkontraktor extends Model
{
    protected $fillable = ['uuid', 'nama', 'alamat', 'nomor_hp', 'npwp'];
}
