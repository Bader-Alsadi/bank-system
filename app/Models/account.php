<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    use HasFactory;

    protected $fillable = ["number", "blance", "type_id", "currncy_id", "branch_id", "user_id", "is_main"];




    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function branch()
    {
        return $this->belongsTo(branch::class);
    }


    public function currncy()
    {
        return $this->belongsTo(Currncy::class);
    }


    public function accountType()
    {
        return $this->belongsTo(AccounType::class, "type_id");
    }
}
