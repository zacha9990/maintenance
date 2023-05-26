<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ToolRequest;
use App\Models\Maintenance;
use App\Models\Position;
use App\Models\MaintenanceHistory;

class Staff extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function toolRequests(){
        return $this->hasMany(ToolRequest::class);
    }

    public function maintenances(){
        return $this->hasMany(Maintenance::class);
    }


    public function maintenanceHistories(){
        return $this->hasMany(MaintenanceHistory::class);
    }
}
