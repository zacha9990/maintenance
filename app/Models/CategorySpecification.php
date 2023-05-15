<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ToolCategory;
use App\Models\ToolSpecification;

class CategorySpecification extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(ToolCategory::class, 'category_id');
    }

    public function toolSpecifications(){
        return $this->hasMany(ToolSpecification::class, 'category_id');
    }
}
