<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;
use App\Models\RepairRequest;
use App\Models\Staff;
use App\Models\MaintenanceSparepart;
use App\Models\MaintenanceDetail;
use App\Models\MaintenanceHistory;

class Maintenance extends Model
{
    use HasFactory;

    public function tool(){
        return $this->belongsTo(Tool::class);
    }


    public function maintenanceHistories(){
        return $this->hasMany(MaintenanceHistory::class);
    }

    public function maintenanceDetail(){
        return $this->hasMany(MaintenanceDetail::class);
    }

    public function repairRequest(){
        return $this->belongsTo(RepairRequest::class);
    }

    public function technician(){
        return $this->belongsTo(Staff::class);
    }

    public function maintenanceSpareparts(){
        return $this->hasMany(MaintenanceSparepart::class);
    }
}
