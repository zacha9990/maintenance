<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maintenance;
use App\Models\Sparepart;

class MaintenanceSparepart extends Model
{
    use HasFactory;

    public function maintenance(){
        return $this->belongsTo(Maintenance::class);
    }

    public function sparepart(){
        return $this->belongsTo(Sparepart::class);
    }
}
