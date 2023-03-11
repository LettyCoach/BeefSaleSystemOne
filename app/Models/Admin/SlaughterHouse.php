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
    public function oxen(): HasMany
    {
        return $this->hasMany(Ox::class,'slaughterHouse_id');
    }
    
}
