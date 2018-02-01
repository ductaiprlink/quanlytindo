<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    protected $table = 'marriages';

    protected $fillable = [
        "marriage_name", 'showhide', 'comments'
    ];

    public $timestamps = true;
}
