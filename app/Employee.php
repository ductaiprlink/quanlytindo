<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Employee extends Model
{
    use Searchable;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'image',
        'date',
        'gender',
        'phone',
        'is_leader',
        'showhide',
        'department_id',
        'designation_id',
        'family_id',
        'dateofjoining',
        'dateofleaving',
        'identity_card_number',
        'religion_name',
        'career',
        'marriage_id',
        'education_id',
        'introduced_id',
        'province_id',
        'district_id',
        'ward_id',
        'street',
        'address',
        'province_tabernacle_id',
        'district_tabernacle_id',
        'ward_tabernacle_id',
        'street_tabernacle',
        'tabernacle'
    ];

    public $timestamps = true;

    // 1 tín đồ chỉ có 1 tình trạng
    public function status()
    {
        return $this->belongsTo('App\Showhide', 'showhide', 'id');
    }

    // 1 tin do co the co nhieu thanh tich
    public function achievements()
    {
        return $this->HasMany('App\Achievement', 'employee_id');
    }

    // 1 tín đồ chỉ thuộc 1 trình độ văn hóa
    public function education()
    {
        return $this->belongsTo('App\Education', 'education_id', 'id');
    }

    // 1 tín đồ chỉ thuộc 1 tình trạng hôn nhân
    public function marriage()
    {
        return $this->belongsTo('App\Marriage', 'marriage_id', 'id');
    }

    // 1 tín đồ chỉ thuộc 1 trụ sở công tác
    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    // 1 tín đồ chỉ sở hữu 1 chức vụ
    public function position()
    {
        return $this->belongsTo('App\Position', 'position_id', 'id');
    }

    // 1 tín đồ chỉ sở hữu 1 chức vụ
    public function introduced()
    {
        return $this->hasOne('App\Employee', 'introduced_id', 'id');
    }
}
