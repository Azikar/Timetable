<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','password','start_date'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];


    public function Roles(){
     
        return $this->belongsToMany(Role::class, 'user_roles');
    
    }
    public function Coordinators(){
     
        return $this->belongsToMany(User::class, 'user_coordinators','subordinate_id');
    
    }
    public function subordinates(){
        return $this->belongsToMany(User::class, 'user_coordinators','user_id','subordinate_id');
    }
    public function Weeks(){
        return $this->hasMany('App\Week');
    }
}
