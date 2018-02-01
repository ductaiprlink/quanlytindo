<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        "education_name", 'showhide'
    ];

    public $timestamps = false;
}
