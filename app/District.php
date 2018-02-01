<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected  $table = 'districts';

    protected $fillable = [
        'name', 'type', 'province_id'
    ];

    public $timestamps = true;

    public function province()
    {
        return $this->belongsTo('App\Province', 'province_id', 'id');

    }
}
