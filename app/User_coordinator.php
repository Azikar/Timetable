<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class User_coordinator extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function subordinator_user($coordinator_id,$subordinate_id){
       return $this->where('user_id',$coordinator_id)->where('subordinate_id',$subordinate_id);
    }
}