<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'products';

    /** @var string[] */
    protected $fillable = [
        'article',
        'name',
        'status',
        'data'
    ];
    protected $casts = [
        'data' => 'array'
    ];
}
