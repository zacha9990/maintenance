<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;
use Spatie\Permission\Models\Role;

class Position extends Model
{
    use HasFactory;

    public function staffs(){
        return $this->hasMany(Staff::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
