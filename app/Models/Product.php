<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'slug', 'description', 'price', 'image', 'id_user'];
    public $incrementing = false;
    protected $keyType = 'string';
}
