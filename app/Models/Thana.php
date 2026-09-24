<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name_bn',
        'name_en',
        'code',
        'city_corporation_code',
        'is_metropolitan',
        'is_active',
    ];

    protected $casts = [
        'is_metropolitan' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
    public function areas()
    {
    return $this->hasMany(Area::class);
    }
}