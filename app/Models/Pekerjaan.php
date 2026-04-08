<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $fillable = ['uuid', 'nama_pekerjaan', 'kode', 'id_klien'];
}
