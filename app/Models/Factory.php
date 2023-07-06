<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Staff;

class Factory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location'];

    public function tools(){
        return $this->hasMany(Tool::class);
    }

    public function spareparts(): BelongsToMany
    {
        return $this->belongsToMany(SparePart::class, 'factory_sparepart')
        ->withPivot('quantity')
        ->withTimestamps();
    }

    public function getFactorySpareParts(): Collection
    {
        return $this->spareParts;
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
}
