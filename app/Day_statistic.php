<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Day_statistic extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_hours','total_free_hours','total_extra_hours','day_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function Day(){
       return $this->belongsTo('App\Day');
    }
}
