<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Karoseri extends Model
{
    use HasUuids;
    protected $fillable = ['id', 'nomor_karoseri'];
    public $incrementing = false;
    protected $keyType = 'string';
}
