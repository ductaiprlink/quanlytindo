<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'member1_id',
        'm1_m2_type',
        'member2_id'
    ];

    public $timestamps = true;

    public function member1()
    {
        return $this->belongsTo('App\Employee', 'member1_id', 'id');
    }

    public function member2()
    {
        return $this->belongsTo('App\Employee', 'member2_id', 'id');
    }

    public function m1_m2()
    {
        return $this->belongsTo('App\Relationship', 'm1_m2_type', 'id');
    }
}
