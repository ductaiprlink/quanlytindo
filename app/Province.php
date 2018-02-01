<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected  $table = 'provinces';

    protected $fillable = [
        'name', 'type'
    ];

    public $timestamps = true;

    public function district()
    {
        return $this->hasMany('App\District');
    }

    // hàm address
    public function address($province_id, $district_id, $ward_id, $street)
    {
        $tinh   = Province::find($province_id);
        $huyen  = District::find($district_id);
        $xa     = Ward::find($ward_id);

        $address = $street.', '.$xa->name.', '.$huyen->name.', '.$tinh->name;
        return $address;
    }
}
