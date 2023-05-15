<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tool;

class ToolFailure extends Model
{
    use HasFactory;

    public function tool(){
        return $this->belongsTo(Tool::class);
    }
}
