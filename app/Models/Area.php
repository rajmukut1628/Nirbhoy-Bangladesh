<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'thana_id',
        'ward_id',
        'name_bn',
        'name_en',
        'code',
        'alias_bn',
        'alias_en',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}