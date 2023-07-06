<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    UserController,
    Auth\LoginController,
    Auth\RegisterController,
    DashboardController,
    ToolController,
    FactoryController,
    MaintenanceController,
    ToolCategoryController,
    SparepartController,
    PositionController,
    RepairRequestController,
    MaintenanceCriteriaController,
    TestController,
    ReportController
};


Auth::routes(['register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/tests', [TestController::class, 'index']);

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('factories')->group(function () {
        Route::get('/', [FactoryController::class, 'index'])->name('factories.index');
        Route::post('/', [FactoryController::class, 'store'])->name('factories.store');
        Route::get('/getSpareparts', [FactoryController::class, 'getSpareparts'])->name('factories.getSpareparts');
        Route::get('/{id}', [FactoryController::class, 'show']);
        Route::put('/{id}', [FactoryController::class, 'update']);
        Route::delete('/{id}', [FactoryController::class, 'destroy'])->name('factories.destroy');
        Route::get('/{factory}/tools', [FactoryController::class, 'tools'])->name('factories.tools');
        Route::get('/{factory}/getTools', [FactoryController::class, 'toolList'])->name('factories.toolList');
    });

    Route::prefix('reports')->group(function () {
        Route::get('/laporanRiwayatMaintenance/{maintenance}', [ReportController::class, 'laporanRiwayatMaintenance'])->name('reports.laporanRiwayatMaintenance');
        Route::post('/laporanRiwayatMaintenance/', [ReportController::class, 'cetakLaporanRiwayatMaintenance'])->name('reports.cetakLaporanRiwayatMaintenance');

        Route::get('/laporanRealisasiMaintenance/{maintenance}', [ReportController::class, 'laporanRealisasiMaintenance'])->name('reports.laporanRealisasiMaintenance');
        Route::post('/laporanRealisasiMaintenance/{maintenance}', [ReportController::class, 'cetakLaporanRealisasiMaintenance'])->name('reports.cetakLaporanRealisasiMaintenance');

        Route::get('/beritaAcaraKerusakan/{maintenance}', [ReportController::class, 'beritaAcaraKerusakan'])->name('reports.beritaAcaraKerusakan');
        Route::post('/beritaAcaraKerusakan/{maintenance}', [ReportController::class, 'cetakBeritaAcaraKerusakan'])->name('reports.cetakBeritaAcaraKerusakan');
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/{param}', [ReportController::class, 'reportForm'])->name('reports.reportForm');
        Route::post('/{param}', [ReportController::class, 'generateForm'])->name('reports.generateForm');
    });

    Route::prefix('tool_categories')->group(function () {
        Route::get('/', [ToolCategoryController::class, 'index'])->name('tool_categories.index');
        // Route::get('/{tool_category}', [ToolCategoryController::class, 'edit'])->name('tool_categories.edit');
        Route::get('/datatables', [ToolCategoryController::class, 'datatable'])->name('tool_categories.datatables');
        Route::post('/', [ToolCategoryController::class, 'store'])->name('tool_categories.store');
        Route::get('/{tool_category}', [ToolCategoryController::class, 'getCategory'])->name('tool_categories.getCategory');
        Route::put('/{tool_category}', [ToolCategoryController::class, 'update'])->name('tool_categories.update');
        Route::delete('/{tool_category}', [ToolCategoryController::class, 'destroy'])->name('tool_categories.destroy');
    });

    Route::get('tool_categories/{category}/tools', [ToolCategoryController::class, 'toolCategory'])->name('tool_categories.tools.index');

    Route::prefix('repair_request')->group(function () {
        Route::get('/', [RepairRequestController::class, 'index'])->name('repair_requests.index');
        Route::get('data', [RepairRequestController::class, 'getData'])->name('repair_requests.data');
        Route::get('create', [RepairRequestController::class, 'create'])->name('repair_requests.create');
        Route::post('/', [RepairRequestController::class, 'store'])->name('repair_requests.store');
        Route::get('{repair_request}', [RepairRequestController::class, 'show'])->name('repair_requests.show');
        Route::get('{repair_request}/edit', [RepairRequestController::class, 'edit'])->name('repair_requests.edit');
        Route::put('{repair_request}', [RepairRequestController::class, 'update'])->name('repair_requests.update');
        Route::delete('{repair_request}', [RepairRequestController::class, 'destroy'])->name('repair_requests.destroy');
        Route::post('/repair_requests/approve', [RepairRequestController::class, 'approve'])->name('repair_requests.approve');
        Route::post('/repair_requests/reject', [RepairRequestController::class, 'reject'])->name('repair_requests.reject');
    });

    Route::prefix('maintenances/{tool}')->group(function () {
        Route::get('show', [MaintenanceController::class, 'show'])->name('maintenances.show');
        Route::get('create', [MaintenanceController::class, 'create'])->name('maintenances.create');
        Route::post('store', [MaintenanceController::class, 'store'])->name('maintenances.store');
        Route::get('edit', [MaintenanceController::class, 'edit'])->name('maintenances.edit');
        Route::put('update', [MaintenanceController::class, 'update'])->name('maintenances.update');
    });
    Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');
    Route::post('/maintenance/start', [MaintenanceController::class, 'startMaintenance'])->name('maintenance.start');
    Route::put('/maintenances/completeMaintenance/{id}', [MaintenanceController::class, 'completeMaintenance'])->name('maintenances.complete');
    Route::put('/maintenance/{id}/cancel', [MaintenanceController::class, 'cancelMaintenance'])->name('maintenance.cancel');
    Route::get('/maintenances/{id}/showDetails', [MaintenanceController::class, 'showDetails'])->name('maintenances.show-details');

    Route::prefix('maintenance-criterias')->group(function () {
        Route::get('/{id}', [MaintenanceCriteriaController::class, 'index'])->name('maintenance-criterias.index');
        Route::get('/{id}/getCriteriasByMaintenance', [MaintenanceCriteriaController::class, 'getCriteriasByMaintenance'])->name('maintenance-criterias.getCriteriasByMaintenance');
        Route::get('/{id}/create', [MaintenanceCriteriaController::class, 'create'])->name('maintenance-criterias.create');
        Route::post('/', [MaintenanceCriteriaController::class, 'store'])->name('maintenance-criterias.store');
        // Route::get('/{maintenance_criteria}', [MaintenanceCriteriaController::class, 'show'])->name('maintenance-criterias.show');
        Route::get('/{maintenance_criteria}/edit', [MaintenanceCriteriaController::class, 'edit'])->name('maintenance-criterias.edit');
        Route::put('/{maintenance_criteria}', [MaintenanceCriteriaController::class, 'update'])->name('maintenance-criterias.update');
        Route::delete('/{maintenance_criteria}', [MaintenanceCriteriaController::class, 'destroy'])->name('maintenance-criterias.destroy');
    });

    Route::get('tools/qrcode/{tool}', [ToolController::class, 'qrcode'])->name('tools.qrcode');

    Route::get('tools/list', [ToolController::class, 'list'])->name('tools.list');
    Route::get('tools/{tool}/spareparts', [ToolController::class, 'getToolSpareparts'])->name('tools.sparepart');
    Route::get('tools/{tool}/maintenance', [ToolController::class, 'getToolMaintenancePeriod'])->name('tools.maintenance');
    Route::get('/my-maintenances', [MaintenanceController::class, 'myMaintenances'])->name('maintenances.my');
    Route::get('/data', [MaintenanceController::class, 'getData'])->name('maintenances.data');

    Route::resource('tools', ToolController::class);

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/chart-data-factory-tools', [DashboardController::class, 'getChartDataFactoryTools'])->name('dashboard.chart-data-factory-tools');
        Route::get('/maintenance-status-over-the-years', [DashboardController::class, 'getChartDataMaintenanceStatusOverTheYears'])
        ->name('dashboard.chart_data_maintenance_status_over_the_years');
        Route::get('/repair-requests-chart',  [DashboardController::class, 'getRepairRequestsChartData'])->name('dashboard.repair-requests-chart');
        Route::get('/tools-chart-by-category', [DashboardController::class, 'getToolsChartByCategoryData'])->name('dashboard.tools-chart-by-category');
    });

    Route::get('spareparts/list', [SparepartController::class, 'list'])->name('spareparts.list');
    Route::get('/factories/{factory}/spareparts/{sparepart}', 'SparepartController@show')->name('factory.spareparts.show');
    Route::resource('spareparts', SparepartController::class);

    Route::get('users/getUsers', [UserController::class, 'getUsers'])->name('users.getUsers');
    Route::resource('users', UserController::class);

    Route::get('positions/getData', [PositionController::class, 'getData'])->name('positions.getData');
    Route::resource('positions', PositionController::class);
});

Route::get('/', [LoginController::class, 'showLoginForm']);
