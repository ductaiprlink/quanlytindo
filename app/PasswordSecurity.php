<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordSecurity extends Model
{
    protected $guarded = [];

    // 1 password security chỉ thuộc duy nhất 1 user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
