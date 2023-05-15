<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;
use App\Models\MaintenanceSparepart;
use App\Models\RequestedItem;

class Sparepart extends Model
{
    use HasFactory;

    public function maintenanceSpareparts(){
        return $this->hasMany(MaintenanceSparepart::class);
    }

    public function tools(){
        return $this->belongsToMany(Tool::class);
    }

    public function items(){
        $this->hasMany(RequestedItem::class);
    }
}
