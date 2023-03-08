<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastoral extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'note',
    ];
}
