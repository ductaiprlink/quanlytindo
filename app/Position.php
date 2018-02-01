<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = "positions";

    protected $fillable = ["position_name"];

    public $timestamps = false;
}