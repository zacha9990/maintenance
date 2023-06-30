<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Models\Factory;
use App\Models\Tool;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\daftar_mesin_alat_produksi_dan_sarana;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Maintenance;
use Carbon\Carbon;
use App\Models\MaintenanceCriteria;

class ReportController extends Controller
{
    public function index()
    {
        $reports = config('reports');

        return view('reports.index', compact('reports'));
    }

    public function reportForm(Request $request, $param)
    {
        $builder = ReportService::getData($param);

        if ($param == 'berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi') {
            $paramTemp = 'berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi';
            $param = $request->get('param', 'default');
            $sort = $request->get('sort', 'default');
            $factoryFilter = $request->get('factory_filter', '');

            $query = Maintenance::where('automated_status', 'damage_report')
            ->where('status', 'completed')
            ->with(['tool:id,name'])
            ->with('tool.factory');

            // Filter by factory
            if (!empty($factoryFilter)) {
                $query->whereHas('tool.factory', function ($query) use ($factoryFilter) {
                    $query->where('id', $factoryFilter);
                });
            }

            // Sorting
            if ($sort === 'name') {
                $query->orderBy('tool.name');
            } elseif ($sort === 'completed_date') {
                $query->orderBy('completed_date');
            }

            $lists = $query->paginate(10);
            $factories = Factory::all();

            return view("reports.list_$paramTemp", compact('lists', 'factories', 'factoryFilter'));
        }

        return view("reports.$param", compact('builder'));
    }

    public function beritaAcaraKerusakan(Request $request, Maintenance $maintenance)
    {
        $builder = ReportService::getData('berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi');

        return view('reports.berita_acara_kerusakan', compact('maintenance', 'builder'));
    }

    public function cetakBeritaAcaraKerusakan(Request $request, Maintenance $maintenance)
    {
        $no_laporan = $request->input('no_laporan');
        $letter_date = Carbon::parse($request->input('letter_date'))->translatedFormat('j F Y');
        $letter_day = Carbon::parse($request->input('letter_date'))->translatedFormat('l');
        $maintenanceName = $request->input('maintenance');
        $kepalaShiftName = $request->input('kepala_shift');
        $toolName = $maintenance->tool->name;
        $pdf = PDF::loadView("exports.berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi", compact('no_laporan', 'maintenance', 'letter_date', 'letter_day', 'maintenanceName', 'kepalaShiftName'));
        return $pdf->stream("berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi.$toolName.pdf");
    }

    public function generateForm(Request $request, $param)
    {

        if ($param == 'daftar_mesin_alat_produksi_dan_sarana') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $no_laporan = $request->input('no_laporan');
            $tools = Tool::where('factory_id', $request->input('factory_id'))->get();

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'tools' => $tools,
            ];
        }

        if ($param == 'daftar_permintaan_perbaikan_mesin_alat_produksi_external') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $startDate = $request->input('date_start');
            $endDate = $request->input('date_end');
            $no_laporan = $request->input('no_laporan');
            $maintenances = ReportService::getRepairRequest($factory->id, $startDate, $endDate);

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'maintenances' => $maintenances,
            ];
        }

        if ($param == 'daftar_permintaan_perbaikan_mesin_alat_produksi_internal') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $startDate = $request->input('date_start');
            $endDate = $request->input('date_end');
            $no_laporan = $request->input('no_laporan');
            $maintenances = ReportService::getRepairRequest($factory->id, $startDate, $endDate, false);

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'maintenances' => $maintenances,
            ];
        }

        if ($param == 'daftar_rekap_pelaksanaan_pekerjaan_perawatan_dan_perbaikan_mesin_alat_produksi') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $startDate = $request->input('date_start');
            $endDate = $request->input('date_end');
            $no_laporan = $request->input('no_laporan');
            $maintenances = ReportService::getFinishedMaintenance($factory->id, $startDate, $endDate, false);
            foreach ($maintenances as $maintenance) {
                $maintenanceDetails = array();
                $maintenanceResultCriteria = array();
                $details =  json_decode($maintenance->details, true);
                if (isset($details['criterias'])) {
                    $criterias = $details['criterias'];
                    foreach ($criterias as $key => $criteria) {
                        $maintenanceCriteria = MaintenanceCriteria::find($key);
                        if ($maintenanceCriteria) {
                            $temp['id'] = $maintenanceCriteria->id;
                            $temp['name'] = $maintenanceCriteria->name;
                            $temp['result'] = $criteria;
                            array_push($maintenanceResultCriteria, $temp);
                        }
                    }
                    $maintenanceDetails['details'] = $details['details'];
                    $maintenanceDetails['criterias'] = $maintenanceResultCriteria;
                    $maintenance->details = $maintenanceDetails;
                }
            }

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'maintenances' => $maintenances,
            ];

            $pdf = PDF::loadView("exports.$param", $data)->setPaper('a4', 'landscape');
            return $pdf->stream("$param.$factory->name.pdf");
        }

        $pdf = PDF::loadView("exports.$param", $data);

        return $pdf->stream("$param.$factory->name.pdf");

        // return Excel::download(new daftar_mesin_alat_produksi_dan_sarana($factory, $no_laporan, $tools), 'daftar_mesin_alat_produksi_dan_sarana', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
