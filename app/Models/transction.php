<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transction extends Model
{
    use HasFactory;

    protected $fillable = ["amount", "account_id", "transction_type_id", "ex_account_id"];
}
