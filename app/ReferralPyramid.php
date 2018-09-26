<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class ReferralPyramid extends Model
{
    use NodeTrait;

    protected $table = 'referral_pyramid';
    protected $fillable = ['user_id','_lft','_rgt','parent_id','name'];
    public $timestamps = false;

    protected $primaryKey = 'user_id';
    public $incrementing = false;


}
