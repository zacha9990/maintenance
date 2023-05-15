<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ToolCategory;

class MaintenanceCriteria extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(ToolCategory::class, 'category_id');
    }
}
