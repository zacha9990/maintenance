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

        $tools = Tool::has('maintenancePeriod')->with('maintenancePeriod')->get();

        foreach ($tools as $tool) {
            $maintenancePeriod = $tool->maintenancePeriod;

            $maintenanceType = $maintenancePeriod->maintenance_type;
            $maintenancePeriodValue = $maintenancePeriod->maintenance_period;

            $startDate = Carbon::now()->startOfDay();
            $endDate = $startDate->copy()->addYear();

            // Check if there is an existing maintenance task within one year
            $lastMaintenanceTaskDate = $tool->maintenances()->max('scheduled_date');
            if ($lastMaintenanceTaskDate) {
                $lastMaintenanceTaskDate = Carbon::parse($lastMaintenanceTaskDate);

                // dd($lastMaintenanceTaskDate, [$lastMaintenanceTaskDate->gte($startDate), $startDate], [$lastMaintenanceTaskDate->lt($endDate), $endDate]);

                if ($lastMaintenanceTaskDate->gte($startDate) && $lastMaintenanceTaskDate->gte($endDate)) {
                    continue; // Skip generating new tasks if already scheduled within one year
                }
            }

            // Determine the start date for generating maintenance tasks
            $generateStartDate = $lastMaintenanceTaskDate ? $lastMaintenanceTaskDate->copy()->addDay() : $startDate;

            $date = $generateStartDate->copy();

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

                 if ($date->isWeekend()) {
                    $date->nextWeekday(); // Move to the nearest weekday
                }

                if ($date->gte($startDate) && $date->lt($endDate)) {
                    $this->createMaintenanceTask($tool, $date);
                }
            }
        }

        $this->info('Maintenance tasks scheduled successfully.');
    }

    private function createMaintenanceTask(Tool $tool, Carbon $date)
    {
        $maintenance = new Maintenance();
        $maintenance->tool_id = $tool->id;
        $maintenance->status = "Dijadwalkan";
        $maintenance->scheduled_date = $date->toDateString();
        // Set other attributes of the maintenance task

        // Save the maintenance task
        $maintenance->save();
    }
}
