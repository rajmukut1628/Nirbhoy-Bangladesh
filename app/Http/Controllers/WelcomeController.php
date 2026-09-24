<?php

namespace App\Http\Controllers;

use App\Models\Accused;

class WelcomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Featured / Hot Profiles
        |--------------------------------------------------------------------------
        |
        | শুধুমাত্র:
        | - Admin approved
        | - Public করার অনুমতি আছে
        | - Hot List-এ দেওয়া হয়েছে
        |
        | এমন profile Welcome Page-এর শুরুতে দেখানো হবে।
        |
        */

        $featuredProfiles = Accused::query()
            ->with([
                'division',
                'district',
                'upazila',
                'union',
                'thana',
                'ward',
            ])
            ->where('verification_status', 'approved')
            ->where('is_public', true)
            ->where('is_hot', true)
            ->orderByRaw('hot_order IS NULL')
            ->orderBy('hot_order')
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', [
            'featuredProfiles' => $featuredProfiles,
        ]);
    }
}