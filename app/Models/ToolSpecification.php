<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;
use App\Models\CategorySpecification;

class ToolSpecification extends Model
{
    use HasFactory;

    public function tool(){
        return $this->belongsTo(Tool::class);
    }

    public function category_specification(){
        return $this->belongsTo(CategorySpecification::class);
    }
}
