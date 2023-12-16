<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currncy extends Model
{
    use HasFactory;

    protected $fillable = ["name", "code", "mas-limet"];
    
}
