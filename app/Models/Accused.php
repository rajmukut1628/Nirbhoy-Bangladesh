<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accused extends Model
{
    use HasFactory, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'alias',
        'photo',
        'phone',
        'organization',
        'occupation',

        // Rural Location
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',

        // Metropolitan / City Location
        'thana_id',
        'ward_id',

        // Additional Area Information
        'area',
        'description',

        // Verification / Public Status
        'verification_status',
        'is_public',
        'is_hot',
        'hot_order',
        'verified_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'is_public'   => 'boolean',
        'is_hot'      => 'boolean',
        'hot_order'   => 'integer',
        'verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Division
    |--------------------------------------------------------------------------
    */

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /*
    |--------------------------------------------------------------------------
    | District
    |--------------------------------------------------------------------------
    */

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Upazila
    |--------------------------------------------------------------------------
    */

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Union
    |--------------------------------------------------------------------------
    */

    public function union()
    {
        return $this->belongsTo(Union::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Thana
    |--------------------------------------------------------------------------
    */

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Ward
    |--------------------------------------------------------------------------
    */

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Only approved accused profiles.
     */
    public function scopeApproved($query)
    {
        return $query->where(
            'verification_status',
            'approved'
        );
    }

    /**
     * Only profiles allowed to be shown publicly.
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Only Hot List profiles.
     */
    public function scopeHot($query)
    {
        return $query
            ->where('is_hot', true)
            ->where('is_public', true)
            ->where(
                'verification_status',
                'approved'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isApproved(): bool
    {
        return $this->verification_status === 'approved';
    }

    public function isPending(): bool
    {
        return $this->verification_status === 'pending';
    }

    public function isUnderReview(): bool
    {
        return $this->verification_status === 'under_review';
    }

    public function isRejected(): bool
    {
        return $this->verification_status === 'rejected';
    }

    public function isDisputed(): bool
    {
        return $this->verification_status === 'disputed';
    }

    public function canBePublic(): bool
    {
        return $this->isApproved() && $this->is_public;
    }

    /*
    |--------------------------------------------------------------------------
    | Location Helpers
    |--------------------------------------------------------------------------
    */

    public function hasRuralLocation(): bool
    {
        return !empty($this->upazila_id);
    }

    public function hasMetropolitanLocation(): bool
    {
        return !empty($this->thana_id);
    }
}