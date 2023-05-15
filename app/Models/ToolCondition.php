<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;

class ToolCondition extends Model
{
    use HasFactory;

    public function tool(){
        return $this->belongsTo(Tool::class);
    }
}
