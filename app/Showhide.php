<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Showhide extends Model
{
    protected  $table = 'showhide';

    protected $fillable = [
        'status'
    ];

    public $timestamps = false;

    // 1 tình trạng thuộc 1 trụ sở duy nhất
//    public function department()
//    {
//        return $this->hasMany('App\Department');
//    }
}
