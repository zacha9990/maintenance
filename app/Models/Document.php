<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Factory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'category', 'factory_id'];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }
}
