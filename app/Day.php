<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Day extends Model
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
    public function Week(){
       return $this->belongsTo('App\Week');
    }
    public function Statistics(){
        return $this->hasOne('App\Day_statistic');
     }
}
