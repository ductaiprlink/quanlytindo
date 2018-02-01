<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected  $table = 'departments';

    protected $fillable = [
        'department_name', 'address', 'street', 'ward_id', 'district_id', 'province_id', 'leader_id', 'showhide'
    ];

    public $timestamps = true;

    // 1 trụ sở có 2 tình trạng hoạt động
    public function status()
    {
        return $this->belongsTo('App\Showhide', 'showhide', 'id');
    }

    // 1 trụ sở có 2 tình trạng hoạt động
    public function leader()
    {
        return $this->belongsTo('App\Employee', 'leader_id', 'id');
    }
}
