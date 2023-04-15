<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Part extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    // public function meats(): HasMany
    // {
    //     return $this->hasMany(Meat::class);
    // }

    public function oxen(): BelongsToMany
    {
        return $this->belongsToMany(Ox::class,'meats','ox_id','part_id');
    }
}
