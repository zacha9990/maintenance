<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;
use App\Models\Staff;

class RepairRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'tool_id',
        'description',
        'status',
        'approved'
    ];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
