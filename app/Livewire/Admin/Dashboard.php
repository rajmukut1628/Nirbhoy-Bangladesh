<?php

namespace App\Livewire\Admin;

use App\Models\Accused;
use App\Models\Report;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        /*
        |--------------------------------------------------------------------------
        | Report Statistics
        |--------------------------------------------------------------------------
        */

        $pendingReports = Report::query()
            ->where('status', 'pending')
            ->count();

        $underReviewReports = Report::query()
            ->where('status', 'under_review')
            ->count();

        $approvedReports = Report::query()
            ->where('status', 'approved')
            ->count();

        $rejectedReports = Report::query()
            ->where('status', 'rejected')
            ->count();

        $duplicateReports = Report::query()
            ->where('status', 'duplicate')
            ->count();

        $archivedReports = Report::query()
            ->where('status', 'archived')
            ->count();

        $totalReports = Report::query()
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Accused / Profile Statistics
        |--------------------------------------------------------------------------
        */

        $totalProfiles = Accused::query()
            ->count();

        $pendingProfiles = Accused::query()
            ->where('verification_status', 'pending')
            ->count();

        $underReviewProfiles = Accused::query()
            ->where('verification_status', 'under_review')
            ->count();

        $approvedProfiles = Accused::query()
            ->where('verification_status', 'approved')
            ->count();

        $rejectedProfiles = Accused::query()
            ->where('verification_status', 'rejected')
            ->count();

        $disputedProfiles = Accused::query()
            ->where('verification_status', 'disputed')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Public Profiles
        |--------------------------------------------------------------------------
        */

        $publicProfilesCount = Accused::query()
            ->where('verification_status', 'approved')
            ->where('is_public', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Hot List
        |--------------------------------------------------------------------------
        |
        | শুধুমাত্র approved + public + hot profile count হবে।
        |
        */

        $hotProfilesCount = Accused::query()
            ->where('verification_status', 'approved')
            ->where('is_public', true)
            ->where('is_hot', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Recent Reports
        |--------------------------------------------------------------------------
        */

        $recentReports = Report::query()
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Profiles
        |--------------------------------------------------------------------------
        */

        $recentProfiles = Accused::query()
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view('livewire.admin.dashboard', [

            // Reports
            'pendingReports' => $pendingReports,
            'underReviewReports' => $underReviewReports,
            'approvedReports' => $approvedReports,
            'rejectedReports' => $rejectedReports,
            'duplicateReports' => $duplicateReports,
            'archivedReports' => $archivedReports,
            'totalReports' => $totalReports,

            // Profiles
            'totalProfiles' => $totalProfiles,
            'pendingProfiles' => $pendingProfiles,
            'underReviewProfiles' => $underReviewProfiles,
            'approvedProfiles' => $approvedProfiles,
            'rejectedProfiles' => $rejectedProfiles,
            'disputedProfiles' => $disputedProfiles,

            // Public / Hot
            'publicProfilesCount' => $publicProfilesCount,
            'hotProfilesCount' => $hotProfilesCount,

            // Recent Data
            'recentReports' => $recentReports,
            'recentProfiles' => $recentProfiles,

        ])->layout('components.layouts.auth');
    }
}