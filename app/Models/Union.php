<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Union extends Model
{
    protected $fillable = [
        'upazila_id',
        'name_bn',
        'name_en',
        'code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}