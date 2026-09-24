<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportEvidence extends Model
{
    protected $table = 'report_evidence';

    protected $fillable = [
        'report_id',
        'type',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
        'sha256_hash',
        'perceptual_hash',
        'is_verified',
        'is_public',
        'admin_note',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}