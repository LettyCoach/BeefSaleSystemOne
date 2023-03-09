<?php

namespace App\Models\Admin;
use App\Models\Common\Ox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\Relations\HasMany;
class TransportCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'note',
    ];
    public function oxen(): HasMany
    {
        return $this->hasMany(Ox::class,'purchaseTransport_Company_id');
    }
}
