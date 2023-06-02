<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ToolCategory;
use App\Models\Factory;
use App\Models\ToolSpecification;
use App\Models\Maintenance;
use App\Models\ToolCondition;
use App\Models\ToolFailure;
use App\Models\Inventory;
use App\Models\Sparepart;
use App\Models\MaintenancePeriod;
use App\Models\MaintenanceDetail;
use App\Models\MaintenanceHistory;
use App\Models\RequestedItem;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'serial_number',
        'function',
        'brand',
        'serial_type',
        'purchase_date',
        'technical_specification',
        'tool_type_id',
        'factory_id',
    ];

    public function category(){
        return $this->belongsTo(ToolCategory::class, 'category_id');
    }

    public function spareparts(){
        return $this->belongsToMany(Sparepart::class, 'tool_spareparts');
    }

    public function maintenanceDetail(){
        return $this->hasMany(MaintenanceDetail::class);
    }

    public function items(){
        $this->hasMany(RequestedItem::class);
    }

    public function maintenanceHistories(){
        return $this->hasMany(MaintenanceHistory::class);
    }

    public function factory(){
        return $this->belongsTo(Factory::class);
    }

    public function specifications(){
        return $this->hasMany(ToolSpecification::class);
    }

    public function inventory(){
        return $this->hasOne(Inventory::class);
    }

    public function maintenancePeriod(){
        return $this->hasOne(MaintenancePeriod::class);
    }

    public function maintenances(){
        return $this->hasMany(Maintenance::class);
    }

    public function toolConditions(){
        return $this->hasMany(ToolCondition::class);
    }

    public function toolFailures(){
        return $this->hasMany(ToolFailure::class);
    }
}
