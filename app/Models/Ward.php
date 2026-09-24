<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'thana_id',
        'ward_number',
        'name_bn',
        'name_en',
        'code',
        'areas_bn',
        'areas_en',
        'is_active',
    ];

    protected $casts = [
        'ward_number' => 'integer',
        'is_active' => 'boolean',
    ];

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}