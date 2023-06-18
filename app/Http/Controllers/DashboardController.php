<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Factory;
use App\Models\Tool;
use App\Models\Maintenance;
use App\Models\RepairRequest;
use App\Models\Sparepart;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $toolsCount = Tool::all()->count();
        $sparePartsCount = Sparepart::all()->count();

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $repairRequests = RepairRequest::whereBetween('created_at', [$startDate, $endDate])->get()->count();

        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addWeek();

        $countScheduledDate = Maintenance::whereNotNull('scheduled_date')
        ->whereBetween('scheduled_date', [$startDate, $endDate])
            ->count();


        return view('admin.dashboard.index', compact('toolsCount', 'sparePartsCount', 'repairRequests', 'countScheduledDate'));
    }

    public function getChartDataFactoryTools()
    {
        $factories = Factory::all();

        $data = [];
        foreach ($factories as $factory) {
            $toolCount = Tool::where('factory_id', $factory->id)->count();
            $data[] = [
                'label' => $factory->name,
                'value' => $toolCount,
            ];
        }

        return response()->json($data);
    }

    public function getChartDataMaintenanceStatusOverTheYears()
    {
        $maintenanceData = Maintenance::selectRaw('DATE_FORMAT(scheduled_date, "%Y-%m") AS month, automated_status, COUNT(*) AS count')
        ->where('scheduled_date', '>=', date('Y-m-d', strtotime('-1 year')))
        ->groupBy('month', 'automated_status')
        ->get();

        $chartData = [];
        $types = $maintenanceData->pluck('automated_status')->unique()->toArray();

        foreach ($maintenanceData as $data) {
            $chartData[$data->month][$data->automated_status] = $data->count;
        }

        $months = array_map(function ($month) {
            return date('F-Y', strtotime($month . '-01'));
        }, array_keys($chartData));

        $datasets = [];

        foreach ($types as $type) {
            $countData = [];

            foreach ($chartData as $month => $data) {
                $countData[] = isset($data[$type]) ? $data[$type] : 0;
            }

            $label = '';

            if ($type === 'automated') {
                $label = 'Dijadwalkan Otomatis';
            } elseif ($type === 'damage_report') {
                $label = 'Laporan Kerusakan';
            } elseif ($type === 'scheduled') {
                $label = 'Dijadwalkan Manual';
            }

            $datasets[] = [
                'label' => $label,
                'data' => $countData,
                'backgroundColor' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
            ];
        }

        $chart = [
            'labels' => $months,
            'datasets' => $datasets,
        ];

        return response()->json($chart);
    }

    public function getRepairRequestsChartData()
    {
        $repairRequestsData = RepairRequest::selectRaw('DATE_FORMAT(created_at, "%Y-%m") AS month, COUNT(*) AS count')
        ->where('created_at', '>=', now()->subYear())
            ->groupBy('month')
            ->get();

        $months = $repairRequestsData->pluck('month')->toArray();
        $counts = $repairRequestsData->pluck('count')->toArray();

        $chartData = [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Jumlah laporan kerusakan',
                    'data' => $counts,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];

        return response()->json($chartData);
    }

    public function getToolsChartByCategoryData()
    {
        $toolData = Tool::selectRaw('tool_type_id, COUNT(*) as count')
        ->groupBy('tool_type_id')
        ->get();

        $labels = [];
        $data = [];
        $colors = [];

        foreach ($toolData as $tool) {
            $labels[] = $tool->category->name;
            $data[] = $tool->count;
            $colors[] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => $colors,
                ]
            ],
        ];

        return response()->json($chartData);
    }
}
