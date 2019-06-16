<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Week extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start','end','total_hours','user_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function Users(){
       return $this->belongsTo('App\User');
    }
    public function Days(){
        return $this->hasMany('App\Day');
    }
}
