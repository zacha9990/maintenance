<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;
use App\Models\CategorySpecification;
use App\Models\MaintenanceCriteria;
use App\Models\MaintenanceDetail;
class ToolCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id'];

    public function parentCategory()
    {
        return $this->belongsTo(ToolCategory::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(ToolCategory::class, 'parent_id');
    }

    public function tools(){
        return $this->hasMany(Tool::class, 'tool_type_id');
    }

    public function specifications(){
        return $this->hasMany(CategorySpecification::class);
    }

    public function maintenanceCriteria(){
        return $this->hasMany(MaintenanceCriteria::class, 'category_id');
    }

    public function maintenanceDetail(){
        return $this->hasMany(MaintenanceDetail::class);
    }
}
