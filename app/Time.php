<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Time extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'start','end','description','user_id','day_id','total_hours'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function Day(){
        return $this->belongsTo('App\Day');
    }
    public function User(){
        return $this->belongsTo('App\User');
    }
}