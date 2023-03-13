<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function meats(): HasMany
    {
        return $this->hasMany(Meat::class);
    }
}
