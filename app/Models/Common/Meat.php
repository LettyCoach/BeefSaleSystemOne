<?php

namespace App\Models\Common;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }
  
}
