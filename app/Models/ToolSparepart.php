<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolSparepart extends Model
{
    use HasFactory;
    protected $primaryKey = ['tool_id', 'sparepart_id'];
}
