<?php

namespace App\Models\Common;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Market;
use App\Models\Admin\TransportCompany;
use App\Models\Admin\Pastoral;
use App\Models\Admin\SlaughterHouse;
use App\Models\Common\Meat;
use App\Models\Admin\Part;


class Ox extends Model
{
    use HasFactory;
    protected $fillable = [
        'registerNumber',
        'name',
        'birthday',
        'sex',
        'user_id',
        'market_id',
        'company_id',
        'purchaseDate',
        'purchasePrice',
        'purchaseTransport_Company_id',
        'loadDate',
        'unloadDate',
        'pastoral_id',
        'accessDate',
        'exportDate',
        'appendInfo',
        'slaughterTransport_Company_id',
        'acceptedDateSlaughterHouse',
        'acceptedWeight',
        'acceptedLevel',
    ];
    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }
    public function pastoral(): BelongsTo
    {
        return $this->belongsTo(Pastoral::class);
    }
    public function purchaseTransportCompany(): BelongsTo
    {
        return $this->belongsTo(TransportCompany::class ,'purchaseTransport_Company_id');
    }
    public function slaughterTransportCompany(): BelongsTo
    {
        return $this->belongsTo(TransportCompany::class ,'slaughterTransport_Company_id');
    }
    public function slaughterHouse(): BelongsTo
    {
        return $this->belongsTo(SlaughterHouse::class ,'slaughterHouse_id');
    }
    // public function meats(): HasMany
    // {
    //     return $this->hasMany(Meat::class,'ox_id');
    // }
    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class,'meats','ox_id','part_id')->withPivot('id','weight', 'price');
    }
}