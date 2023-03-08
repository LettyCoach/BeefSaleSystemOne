<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlaughterHouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'note',
    ];
    
}
