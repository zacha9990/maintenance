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

        if ($param == 'laporan_realisasi_maintenance') {
            $paramTemp = 'laporan_realisasi_maintenance';
            $param = $request->get('param', 'default');
            $sort = $request->get('sort', 'default');
            $factoryFilter = $request->get('factory_filter', '');

            $query = Maintenance::where('status', 'completed')
                ->with(['tool:id,name'])
                ->with('tool.factory')
                ->orderBy('maintenances.completed_date', 'desc');

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
        $action = $request->input('action');
        $no_laporan = $request->input('no_laporan');
        $letter_date = Carbon::parse($request->input('letter_date'))->translatedFormat('j F Y');
        $letter_day = Carbon::parse($request->input('letter_date'))->translatedFormat('l');
        $maintenanceName = $request->input('maintenance');
        $kepalaShiftName = $request->input('kepala_shift');
        $nama_spv_prod_maint = $request->input('nama_spv_prod_maint');
        $toolName = $maintenance->tool->name;
        $param = "berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi";
        $maintenanceId = $request->input('maintenance_id');
        if ($action == 'print')
        {
            $preview = false;
            $pdf = PDF::loadView("exports.berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi", compact('no_laporan', 'maintenance', 'letter_date', 'letter_day', 'maintenanceName', 'kepalaShiftName', 'preview', 'param', 'maintenanceId', 'nama_spv_prod_maint'));
            return $pdf->stream("berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi.$toolName.pdf");
        }

        if ($action == 'preview')
        {
            $preview = true;
            return view("exports.$param", compact('no_laporan', 'maintenance', 'letter_date', 'letter_day', 'maintenanceName', 'kepalaShiftName', 'preview', 'param', 'maintenanceId', 'nama_spv_prod_maint'));
        }

    }

    public function generateForm(Request $request, $param)
    {
        $action = $request->input('action');

        if ($param == 'daftar_mesin_alat_produksi_dan_sarana') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $no_laporan = $request->input('no_laporan');
            $tools = Tool::where('factory_id', $request->input('factory_id'))->get();
            $nama_maintenance = $request->input('nama_maintenance');
            $kepala_pabrik = $request->input('kepala_pabrik');
            $nama_spv_prod_maint = $request->input('nama_spv_prod_maint');

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'tools' => $tools,
                'nama_spv_prod_maint' => $nama_spv_prod_maint,
                'nama_maintenance' => $nama_maintenance,
                'kepala_pabrik' => $kepala_pabrik,
                'param' => $param
            ];
        }

        if ($param == 'daftar_permintaan_perbaikan_mesin_alat_produksi_external') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $startDate = $request->input('date_start');
            $endDate = $request->input('date_end');
            $no_laporan = $request->input('no_laporan');
            $maintenances = ReportService::getRepairRequest($factory->id, $startDate, $endDate);
            $nama_maintenance = $request->input('nama_maintenance');
            $kepala_pabrik = $request->input('kepala_pabrik');
            $nama_spv_prod_maint = $request->input('nama_spv_prod_maint');

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'maintenances' => $maintenances,
                'nama_spv_prod_maint' => $nama_spv_prod_maint,
                'nama_maintenance' => $nama_maintenance,
                'kepala_pabrik' => $kepala_pabrik,
                'param' => $param
            ];
        }

        if ($param == 'daftar_permintaan_perbaikan_mesin_alat_produksi_internal') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $startDate = $request->input('date_start');
            $endDate = $request->input('date_end');
            $no_laporan = $request->input('no_laporan');
            $maintenances = ReportService::getRepairRequest($factory->id, $startDate, $endDate, false);
            $nama_maintenance = $request->input('nama_maintenance');
            $nama_spv_prod_maint = $request->input('nama_spv_prod_maint');

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'maintenances' => $maintenances,
                'nama_spv_prod_maint' => $nama_spv_prod_maint,
                'nama_maintenance' => $nama_maintenance,
                'param' => $param
            ];
        }

        if ($param == 'daftar_pemeriksaan_mesin_alat_produksi') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $no_laporan = $request->input('no_laporan');
            $nama_maintenance = $request->input('nama_maintenance');
            $kepala_pabrik = $request->input('kepala_pabrik');
            $month_year = $request->input('month_year');

            $tools = ReportService::getToolListsMonthly($factory->id, $month_year, 1);

            $bulan_tahun = Carbon::parse($month_year)->translatedFormat('F Y');
            $month = Carbon::parse($month_year)->format('m');
            $year = Carbon::parse($month_year)->format('Y');

            foreach ($tools as $tool) {
                $maintenances = $tool->maintenances;

                foreach ($maintenances as $maintenance) {
                    $maintenanceDetails = [];
                    $maintenanceResultCriteria = [];
                    $details = json_decode($maintenance->details, true);
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
            }

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'tools' => $tools,
                'nama_maintenance' => $nama_maintenance,
                'kepala_pabrik' => $kepala_pabrik,
                'bulan_tahun' => $bulan_tahun,
                'month' => $month,
                'year' => $year,
                'param' => $param
            ];

            if ($action == 'print')
            {
                $data['preview'] = false;
                $pdf = PDF::loadView("exports.$param", $data)->setPaper('f4', 'landscape');

                return $pdf->stream("$param.$factory->name.pdf");
            }

            if ($action == 'preview')
            {
                $data['preview'] = true;
                return view("exports.$param", $data);
            }


        }

        if ($param == 'daftar_pemeriksaan_generator_set') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $no_laporan = $request->input('no_laporan');
            $nama_maintenance = $request->input('nama_maintenance');
            $kepala_pabrik = $request->input('kepala_pabrik');
            $month_year = $request->input('month_year');

            $tools = ReportService::getToolListsMonthly($factory->id, $month_year, 2);

            $bulan_tahun = Carbon::parse($month_year)->translatedFormat('F Y');
            $month = Carbon::parse($month_year)->format('m');
            $year = Carbon::parse($month_year)->format('Y');

            foreach ($tools as $tool) {
                $maintenances = $tool->maintenances;

                foreach ($maintenances as $maintenance) {
                    $maintenanceDetails = [];
                    $maintenanceResultCriteria = [];
                    $details = json_decode($maintenance->details, true);
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
            }

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'tools' => $tools,
                'nama_maintenance' => $nama_maintenance,
                'kepala_pabrik' => $kepala_pabrik,
                'bulan_tahun' => $bulan_tahun,
                'month' => $month,
                'year' => $year,
                'param' => $param
            ];
             if ($action == 'print')
            {
                $data['preview'] = false;
                $pdf = PDF::loadView("exports.$param", $data)->setPaper('f4', 'landscape');

                return $pdf->stream("$param.$factory->name.pdf");
            }

            if ($action == 'preview')
            {
                $data['preview'] = true;
                return view("exports.$param", $data);
            }
        }

        if ($param == 'daftar_rekap_pelaksanaan_pekerjaan_perawatan_dan_perbaikan_mesin_alat_produksi') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $startDate = $request->input('date_start');
            $endDate = $request->input('date_end');
            $no_laporan = $request->input('no_laporan');
            $nama_maintenance = $request->input('nama_maintenance');
            $kepala_pabrik = $request->input('kepala_pabrik');
            $nama_spv_prod_maint = $request->input('nama_spv_prod_maint');
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
                'nama_spv_prod_maint' => $nama_spv_prod_maint,
                'nama_maintenance' => $nama_maintenance,
                'kepala_pabrik' => $kepala_pabrik,
                'param' => $param
            ];
             if ($action == 'print')
            {
                $data['preview'] = false;
                $pdf = PDF::loadView("exports.$param", $data)->setPaper('f4', 'landscape');

                return $pdf->stream("$param.$factory->name.pdf");
            }

            if ($action == 'preview')
            {
                $data['preview'] = true;
                return view("exports.$param", $data);
            }
        }

        if ($param == 'daftar_pemeriksaan_gedung_dan_sarana_lainnya') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $no_laporan = $request->input('no_laporan');
            $nama_maintenance = $request->input('nama_maintenance');
            $kepala_pabrik = $request->input('kepala_pabrik');
            $year = $request->input('year');

            $tools = ReportService::getToolListsYearly($factory->id, $year, 3);

            foreach ($tools as $tool) {
                $maintenances = $tool->maintenances;

                foreach ($maintenances as $maintenance) {
                    $maintenanceDetails = [];
                    $maintenanceResultCriteria = [];
                    $details = json_decode($maintenance->details, true);
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
            }

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'tools' => $tools,
                'nama_maintenance' => $nama_maintenance,
                'kepala_pabrik' => $kepala_pabrik,
                'year' => $year,
                'param' => $param
            ];

            if ($action == 'print')
            {
                $data['preview'] = false;
                $pdf = PDF::loadView("exports.$param", $data)->setPaper('f4', 'landscape');

                return $pdf->stream("$param.$factory->name.pdf");
            }

            if ($action == 'preview')
            {
                $data['preview'] = true;
                return view("exports.$param", $data);
            }
        }

        if ($param == 'daftar_pemeriksaan_alat_pemadam_kebakaran') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $no_laporan = $request->input('no_laporan');
            $nama_maintenance = $request->input('nama_maintenance');
            $kepala_pabrik = $request->input('kepala_pabrik');
            $year = $request->input('year');

            $tools = ReportService::getToolListsYearly($factory->id, $year, 4);

            foreach ($tools as $tool) {
                $maintenances = $tool->maintenances;

                foreach ($maintenances as $maintenance) {
                    $maintenanceDetails = [];
                    $maintenanceResultCriteria = [];
                    $details = json_decode($maintenance->details, true);
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
            }

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'tools' => $tools,
                'nama_maintenance' => $nama_maintenance,
                'kepala_pabrik' => $kepala_pabrik,
                'year' => $year,
                'param' => $param
            ];

             if ($action == 'print')
            {
                $data['preview'] = false;
                $pdf = PDF::loadView("exports.$param", $data)->setPaper('f4', 'landscape');

                return $pdf->stream("$param.$factory->name.pdf");
            }

            if ($action == 'preview')
            {
                $data['preview'] = true;
                return view("exports.$param", $data);
            }
        }

        if ($param == 'daftar_pemeliharaan_komputer') {
            $factory = Factory::findOrFail($request->input('factory_id'));
            $no_laporan = $request->input('no_laporan');
            $nama_maintenance = $request->input('nama_maintenance');
            $kepala_pabrik = $request->input('kepala_pabrik');
            $nama_spv_prod_maint = $request->input('nama_spv_prod_maint');
            $year = $request->input('year');

            $tools = ReportService::getToolListsYearly($factory->id, $year, 5);

            foreach ($tools as $tool) {
                $maintenances = $tool->maintenances;

                foreach ($maintenances as $maintenance) {
                    $maintenanceDetails = [];
                    $maintenanceResultCriteria = [];
                    $details = json_decode($maintenance->details, true);
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
            }

            $data = [
                'no_laporan' => $no_laporan, // Replace with your variable values
                'factory' => $factory,
                'tools' => $tools,
                'nama_spv_prod_maint' => $nama_spv_prod_maint,
                'nama_maintenance' => $nama_maintenance,
                'kepala_pabrik' => $kepala_pabrik,
                'year' => $year,
                'param' => $param
            ];

            if ($action == 'print')
            {
                $data['preview'] = false;
                $pdf = PDF::loadView("exports.$param", $data)->setPaper('f4', 'landscape');

                return $pdf->stream("$param.$factory->name.pdf");
            }

            if ($action == 'preview')
            {
                $data['preview'] = true;
                return view("exports.$param", $data);
            }
        }


        if ($action == 'print')
        {
            $data['preview'] = false;

            $pdf = PDF::loadView("exports.$param", $data);

            return $pdf->stream("$param.$factory->name.pdf");
        }

        if ($action == 'preview')
        {
            $data['preview'] = true;

            return view("exports.$param", $data);
        }
    }

    public function laporanRealisasiMaintenance(Maintenance $maintenance)
    {
        $builder = ReportService::getData('laporan_realisasi_maintenance');

        return view('reports.laporan_realisasi_maintenance', compact('maintenance', 'builder'));
    }

    public function cetakLaporanRealisasiMaintenance(Request $request, Maintenance $maintenance)
    {
        $action = $request->input('action');
        $no_laporan = $request->input('no_laporan');
        $nama_maintenance = $request->input('nama_maintenance');
        $nama_spv = $request->input('nama_spv');
        $kepala_pabrik = $request->input('kepala_pabrik');
        $realisasi_dari_formulir = $request->input('realisasi_dari_formulir');

        $data = [
            'no_laporan' => $no_laporan, // Replace with your variable values
            'nama_maintenance' => $nama_maintenance,
            'maintenance' => $maintenance,
            'nama_spv' => $nama_spv,
            'kepala_pabrik' => $kepala_pabrik,
            'realisasi_dari_formulir' => $realisasi_dari_formulir,
            'param' => "laporan_realisasi_maintenance"
        ];

        $fileName = $maintenance->tool->name;

        $maintenanceId = $request->input('maintenance_id');
        if ($action == 'print')
        {
            $data['preview'] = false;
            $data['maintenanceId'] = $maintenanceId;

            $pdf = PDF::loadView("exports.laporan_realisasi_maintenance", $data);
            return $pdf->stream("laporan_realisasi_maintenance_$fileName.pdf");

        }

        if ($action == 'preview')
        {
            $data['preview'] = true;
            $data['maintenanceId'] = $maintenanceId;
            return view("exports.laporan_realisasi_maintenance", $data);
        }

        // return view("exports.laporan_realisasi_maintenance", $data);
    }

    public function laporanRiwayatMaintenance(Maintenance $maintenance)
    {
        $builder = ReportService::getData('laporan_riwayat_maintenance');

        return view('reports.laporan_riwayat_maintenance', compact('maintenance', 'builder'));
    }

    public function cetakLaporanRiwayatMaintenance(Request $request)
    {
        $action = $request->input('action');
        $no_laporan = $request->input('no_laporan');
        $nama_spv_prod_maint = $request->input('nama_spv_prod_maint');
        $nama_maintenance = $request->input('nama_maintenance');
        $kepala_pabrik = $request->input('kepala_pabrik');
        $tahun = $request->input('year');
        $factory = Factory::findOrFail($request->input('factory_id'));
        $maintenances = ReportService::getFactoryMaintenances($factory->id, $tahun);

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
            'nama_maintenance' => $nama_maintenance,
            'maintenances' => ReportService::getFactoryMaintenances($factory->id, $tahun),
            'year' => $tahun,
            'nama_spv_prod_maint' => $nama_spv_prod_maint,
            'kepala_pabrik' => $kepala_pabrik,
            'factory' => $factory,
            'param' => "laporan_riwayat_maintenance"
        ];

        $fileName = $factory->name . "_" . $tahun;

        if ($action == 'print') {
            $data['preview'] = false;
            $data['maintenanceId'] = false;

            $pdf = PDF::loadView("exports.laporan_riwayat_maintenance", $data)->setPaper('a4', 'landscape');
            return $pdf->stream("laporan_riwayat_maintenance_$fileName.pdf");
        }

        if ($action == 'preview') {
            $data['preview'] = true;
            $data['maintenanceId'] = false;
            return view("exports.laporan_riwayat_maintenance", $data);
        }


    }
}
