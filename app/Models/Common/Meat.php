<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meat extends Model
{
    use HasFactory;
    protected $fillable = [
        'ox_id',
        'part_id',
        'weight',
        'price',
    ];
}
