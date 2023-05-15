<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maintenance;
use App\Models\Tool;
use App\Models\ToolCategory;

class MaintenanceDetail extends Model
{
    use HasFactory;

    public function maintenance(){
        return $this->belongsTo(Maintenance::class);
    }

    public function tool(){
        return $this->belongsTo(Tool::class);
    }

    public function category(){
        return $this->belongsTo(ToolCategory::class, 'category_id');
    }
}
