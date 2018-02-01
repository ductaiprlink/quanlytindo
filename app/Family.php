<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $table = 'families';

    protected $fillable = [
        'family_name',
        'present_id',
        'province_id',
        'district_id',
        'ward_id',
        'street',
        'address'
    ];

    public $timestamps = true;

    // 1 gia đình thì có 1 nnười đại diện
    public function present()
    {
        return $this->belongsTo('App\Employee', 'present_id', 'id');
    }
}
