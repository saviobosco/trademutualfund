<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $guarded = ['id'];
    protected $hidden = [
        'last_investment_plan',
    ];
}
