<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;
use App\Models\ToolRequest;
use App\Models\Sparepart;

class RequestedItem extends Model
{
    use HasFactory;

    public function sparepart(){
        return $this->belongsTo(Sparepart::class);
    }

    public function tool(){
        return $this->belongsTo(Tool::class);
    }

    public function toolRequest(){
        return $this->belongsTo(Sparepart::class);
    }

}
