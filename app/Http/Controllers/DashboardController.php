<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * ダッシュボードを表示
     */
    public function index()
    {
        // 最近の活動を取得
        $recentActivities = \App\Models\Activity::with(['company', 'contact', 'deal'])
            ->latest()
            ->take(5)
            ->get();

        // 進行中の商談を取得
        $activeDeals = \App\Models\Deal::with(['company', 'contact'])
            ->whereNotIn('status', ['closed_won', 'closed_lost'])
            ->latest()
            ->take(5)
            ->get();

        // 今後の予定を取得
        $upcomingActivities = \App\Models\Activity::with(['company', 'contact'])
            ->where('status', 'scheduled')
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at')
            ->take(5)
            ->get();

        // 企業数、担当者数、商談数を取得
        $counts = [
            'companies' => \App\Models\Company::count(),
            'contacts' => \App\Models\Contact::count(),
            'deals' => \App\Models\Deal::count(),
            'won_deals' => \App\Models\Deal::where('status', 'closed_won')->count(),
        ];

        return view('dashboard', compact(
            'recentActivities',
            'activeDeals',
            'upcomingActivities',
            'counts'
        ));
    }
}
