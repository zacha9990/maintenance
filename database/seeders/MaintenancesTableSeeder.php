<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Maintenance;
use App\Models\RepairRequest;
use App\Models\Tool;
use App\Models\Staff;

class MaintenancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $statuses = ['not_assigned', 'assigned', 'on_progress', 'completed', 'cancelled'];
        $types = ['Internal', 'External'];
        $automatedStatuses = ['automated', 'scheduled', 'damage_report'];

        $repairRequests = RepairRequest::pluck('id')->toArray();
        $existingRepairIds = [];

        for ($i = 0; $i < 250; $i++) {
            $repairId = null;
            if ($faker->boolean(50) && count($repairRequests) > 0) {
                $repairId = $faker->randomElement($repairRequests);
                $existingRepairIds[] = $repairId;
                $repairRequests = array_diff($repairRequests, $existingRepairIds);
            }

            $toolId = null;
            if ($repairId && $repairRequest = RepairRequest::find($repairId)) {
                $toolId = $repairRequest->tool_id;
            } else {
                $toolId = Tool::inRandomOrder()->first()->id;
            }

            $scheduledDate = $faker->dateTimeBetween('-1 year');
            if ($repairId && $repairRequest) {
                $approvedAt = $repairRequest->approved_at;
                $scheduledDate = $faker->dateTimeBetween($approvedAt, 'now');
            }

            $type = $faker->randomElement($types);

            $automatedStatus = 'automated';
            if ($repairId && $repairRequest) {
                $automatedStatus = 'damage_report';
            } else {
                $automatedStatus = $faker->randomElement($automatedStatuses);
            }

            $status = $faker->randomElement($statuses);

            $assignDate = null;
            if ($status == 'assigned') {
                $assignDate = $faker->dateTimeBetween($scheduledDate, 'now');
            }

            $startDate = null;
            if ($status == 'on_progress') {
                $startDate = $faker->dateTimeBetween($assignDate, 'now');
            }

            $completedDate = null;
            if ($status == 'completed') {
                $completedDate = $faker->dateTimeBetween($startDate, 'now');
            }

            $responsibleTechnician = null;
            if ($status == 'assigned') {
                if ($repairId && $repairRequest) {
                    $responsibleTechnician = $repairRequest->staff_id;
                } else {
                    $responsibleTechnician = Staff::inRandomOrder()->first()->id;
                }
            }

            $result = null;
            if ($status != 'completed') {
                $result = $faker->text;
            }

            $details = null;
            if ($status != 'completed') {
                $tool = Tool::find($toolId);
                $criterias = $tool->category->maintenanceCriteria;
                foreach ($criterias as $criteria)
                {
                    $details['criterias'][$criteria->id] = (random_int(0, 1) === 0) ? 'good' : 'not_good';
                }
                $details['details'] = $faker->text;    
                $details = json_encode($details);        
            }

            $actionTakenInternal = null;
            if ($type == 'External' && $status == 'completed') {
                $actionTakenInternal = $faker->text(120);
            }

            $actionTakenExternal = null;
            if ($type == 'Internal' && $status == 'completed') {
                $actionTakenExternal = $faker->text(120);
            }



            

            Maintenance::create([
                'tool_id' => $toolId,
                'repair_id' => $repairId,
                'scheduled_date' => $scheduledDate,
                'type' => $type,
                'automated_status' => $automatedStatus,
                'description' => $faker->text,
                'status' => $status,
                'assign_date' => $assignDate,
                'start_date' => $startDate,
                'completed_date' => $completedDate,
                'time' => $faker->time,
                'responsible_technician' => $responsibleTechnician,
                'result' => $result,
                'details' => $details,
                'action_taken_internal' => $actionTakenInternal,
                'action_taken_external' => $actionTakenExternal,
                'created_at' => $faker->dateTimeBetween('-1 year'),
                'updated_at' => $faker->dateTimeBetween('-1 year'),
            ]);
        }
    }
}
