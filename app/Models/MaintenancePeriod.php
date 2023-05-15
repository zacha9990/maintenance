<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenancePeriod extends Model
{
    use HasFactory;
    protected $primaryKey = 'tool_id';
}
