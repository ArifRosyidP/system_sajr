<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['uuid', 'nama_perusahaan', 'nama_pemilik', 'alamat', 'nomor_hp', 'npwp'];
}
