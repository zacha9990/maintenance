<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;
use App\Models\MaintenanceSparepart;
use App\Models\RequestedItem;

class Sparepart extends Model
{
    use HasFactory;

    protected $fillable = ['sparepart_name', 'sparepart_quantity', 'sparepart_availability'];

    public function maintenanceSpareparts()
    {
        return $this->hasMany(MaintenanceSparepart::class);
    }

    public function tools()
    {
        return $this->belongsToMany(Tool::class);
    }

    public function items()
    {
        $this->hasMany(RequestedItem::class);
    }

    public function getActionButtons()
    {
        return '<a href="' . route('spareparts.edit', $this->id) . '" class="btn btn-primary btn-sm">Edit</a>' .
        '<a href="' . route('spareparts.show', $this->id) . '" class="btn btn-info btn-sm">View</a>' .
        '<button type="button" data-id="' . $this->id . '" class="btn btn-danger btn-sm btn-delete">Delete</button>';
    }
}
