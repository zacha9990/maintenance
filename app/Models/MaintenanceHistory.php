<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maintenance;
use App\Models\Tool;
use App\Models\Staff;

class MaintenanceHistory extends Model
{
    use HasFactory;

    public function maintenance(){
        return $this->belongsTo(Maintenance::class);
    }

    public function tool(){
        return $this->belongsTo(Tool::class);
    }

    public function staff(){
        return $this->belongsTo(Staff::class);
    }
}

