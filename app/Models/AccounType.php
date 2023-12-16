<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccounType extends Model
{
    use HasFactory;

    protected $fillable = ["type_name"];


    public function accounts (){
        return $this->hasMany(account::class);
    }
}
