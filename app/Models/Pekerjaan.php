<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasUuids;
    protected $fillable = ['id', 'nama_pekerjaan', 'kode', 'id_klien'];
    public $incrementing = false;
    protected $keyType = 'string';
}
