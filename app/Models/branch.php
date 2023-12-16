<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class branch extends Model
{
    use HasFactory;

    protected $fillable = ["name", "code"];

    public function accounts()
    {
        return $this->hasMany(account::class);
    }
}
