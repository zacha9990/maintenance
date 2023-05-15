<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;

class MaintenancePeriod extends Model
{
    use HasFactory;
    protected $primaryKey = 'tool_id';

    public function tool(){
        return $this->belongsTo(Tool::class);
    }
}
