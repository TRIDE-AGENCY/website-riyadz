<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $range = $request->get('date_range', 'weekly');

        $start = match ($range) {
            'weekly'  => now()->startOfWeek(),
            'monthly' => now()->startOfMonth(),
            'yearly'  => now()->startOfYear(),
            default   => now()->startOfWeek(),
        };

        $period = Period::create($start, now());

        $visitsByDay = $this->safeAnalytics(
            fn() => Analytics::get($period, ['screenPageViews'], ['date'])
                ->map(fn($r) => [
                    'date'  => $r['date']->format('Y-m-d'),
                    'label' => $r['date']->format('d/m/y'),
                    'views' => $r['screenPageViews'],
                ]),
            collect()
        );

        $visitsUsersTrend = $this->safeAnalytics(
            fn() => Analytics::get($period, ['screenPageViews', 'totalUsers'], ['date'])
                ->map(fn($r) => [
                    'date'   => $r['date']->format('Y-m-d'),
                    'label'  => $r['date']->format('d/m/y'),
                    'views'  => $r['screenPageViews'],
                    'users'  => $r['totalUsers'],
                ]),
            collect()
        );

        $topPages = $this->safeAnalytics(
            fn() => Analytics::fetchMostVisitedPages($period)
                ->groupBy('pageTitle')
                ->map(fn($items) => [
                    'pageTitle'        => $items->first()['pageTitle'],
                    'pageUrl'          => $items->first()['fullPageUrl'],
                    'screenPageViews'  => $items->sum('screenPageViews'),
                ])
                ->sortByDesc('screenPageViews')
                ->values(),
            collect()
        );

        $totalVisits = $visitsByDay->sum('views');

        $totalUsers = $this->safeAnalytics(
            fn() => Analytics::get($period, ['totalUsers'])->sum('totalUsers'),
            0
        );

        $newUsers = $this->safeAnalytics(
            fn() => Analytics::get($period, ['newUsers'])->sum('newUsers'),
            0
        );

        $bounceRate = $this->safeAnalytics(
            fn() => round(
                (Analytics::get($period, ['bounceRate'])->first()['bounceRate'] ?? 0) * 100,
                2
            ),
            0
        );

        $avgSessionDuration = $this->safeAnalytics(
            fn() => gmdate(
                'i:s',
                (int) (Analytics::get($period, ['averageSessionDuration'])->first()['averageSessionDuration'] ?? 0)
            ),
            '00:00'
        );

        return inertia('Admin/Dashboard/Index', [
            'total_visits'          => $totalVisits,
            'total_users'           => $totalUsers,
            'new_users'             => $newUsers,
            'bounce_rate'           => $bounceRate,
            'avg_session_duration'  => $avgSessionDuration,

            'visits_users_trend'    => $visitsUsersTrend,
            'countries'             => $this->safeAnalytics(
                fn() => Analytics::get($period, ['screenPageViews'], ['country'])->take(5),
                collect()
            ),
            'referrers'             => $this->safeAnalytics(
                fn() => Analytics::fetchTopReferrers($period)->take(5),
                collect()
            ),
            'browsers'              => $this->safeAnalytics(
                fn() => Analytics::get($period, ['screenPageViews'], ['browser'])->take(5),
                collect()
            ),
            'devices'               => $this->safeAnalytics(
                fn() => Analytics::get($period, ['screenPageViews'], ['deviceCategory'])->take(5),
                collect()
            ),
            'top_pages'             => $topPages,

            'filters' => [
                'date_range' => $range,
            ],
        ]);
    }

    private function safeAnalytics(callable $callback, $fallback)
    {
        try {
            return $callback();
        } catch (\Throwable $e) {
            report($e);
            return $fallback;
        }
    }
}
