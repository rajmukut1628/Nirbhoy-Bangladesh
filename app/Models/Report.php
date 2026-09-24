<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tracking_code',
        'accused_id',

        'accused_name',
        'alias',
        'phone',
        'organization',

        'division_id',
        'district_id',
        'upazila_id',
        'union_id',

        'incident_area',
        'incident_date',
        'incident_time',

        'amount_demanded',
        'amount_paid',

        'description',

        'reporter_name',
        'reporter_phone',
        'reporter_email',
        'is_anonymous',

        'status',

        'admin_note',
        'rejection_reason',

        'submission_ip_hash',
        'content_hash',

        'reviewed_by',
        'reviewed_at',
        'thana_id',
        'ward_id',
    ];

    protected $casts = [
        'incident_date' => 'date',
        'amount_demanded' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'is_anonymous' => 'boolean',
        'reviewed_at' => 'datetime',
    ];

    public function accused()
    {
        return $this->belongsTo(Accused::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function union()
    {
        return $this->belongsTo(Union::class);
    }

    public function evidences()
    {
        return $this->hasMany(ReportEvidence::class);
    }

    public function reviews()
    {
        return $this->hasMany(ReportReview::class);
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
    public function thana()
        {
    return $this->belongsTo(Thana::class);
        }

public function ward()
        {
    return $this->belongsTo(Ward::class);
        }
}