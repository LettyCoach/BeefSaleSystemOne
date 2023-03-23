<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Common\Ox;

class Pastoral extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'note',
    ];
    public function oxen(): HasMany
    {
        return $this->hasMany(Ox::class,'pastoral_id');
    }
}
