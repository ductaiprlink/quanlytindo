<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected  $table = 'wards';

    protected $fillable = [
        'name', 'type', 'district_id'
    ];

    public $timestamps = true;

    public function district()
    {
        return $this->belongsTo('App\District', 'district_id', 'id');

    }
}
