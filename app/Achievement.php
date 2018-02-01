<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected  $table = 'achievements';

    protected $fillable = [
        'employee_id', 'date', 'advantage', 'disadvantage'
    ];

    public $timestamps = true;

    // 1 tin do co the co nhieu thanh tich
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }
}
