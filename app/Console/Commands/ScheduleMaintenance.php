<?php

namespace App\Console\Commands;

use App\Models\Tool;
use App\Models\MaintenancePeriod;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ScheduleMaintenance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule maintenance tasks based on maintenance periods';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Scheduling maintenance tasks...');

        $tools = Tool::with('maintenancePeriods')->get();

        foreach ($tools as $tool) {
            $maintenancePeriods = $tool->maintenancePeriods;

            foreach ($maintenancePeriods as $maintenancePeriod) {
                $maintenanceType = $maintenancePeriod->maintenance_type;
                $maintenancePeriodValue = $maintenancePeriod->maintenance_period;

                $startDate = Carbon::now()->startOfDay();
                $endDate = $startDate->copy()->addYear();

                $date = $startDate->copy();

                while ($date->lt($endDate)) {
                    switch ($maintenanceType) {
                        case 'weekly':
                            $date->addWeeks($maintenancePeriodValue);
                            break;
                        case 'monthly':
                            $date->addMonths($maintenancePeriodValue);
                            break;
                        case 'yearly':
                            $date->addYears($maintenancePeriodValue);
                            break;
                    }

                    if ($date->gte($startDate) && $date->lt($endDate)) {
                        $this->createMaintenanceTask($tool, $date);
                    }
                }
            }
        }

        $this->info('Maintenance tasks scheduled successfully.');
    }

    private function createMaintenanceTask(Tool $tool, Carbon $date)
    {
        $maintenance = new Maintenance();
        $maintenance->tool_id = $tool->id;
        // Set other attributes of the maintenance task

        // Save the maintenance task
        $maintenance->save();
    }
}
