<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tool;

class Factory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location'];

    public function tools(){
        return $this->hasMany(Tool::class);
    }
}
