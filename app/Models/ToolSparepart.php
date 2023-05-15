<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;
use App\Models\Sparepart;

class ToolSparepart extends Model
{
    use HasFactory;
    protected $primaryKey = ['tool_id', 'sparepart_id'];

}
