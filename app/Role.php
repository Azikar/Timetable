<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Role extends Model
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
    public function Users(){
     
        return $this->belongsToMany(User::class, 'user_roles')->get();
    
    }
}
