<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function hasRole( $roles)
    {

    
        if($roles=='Advisor'){
            return true;
        }else{
            return false;
        }
        if($roles=='Client'){
            return true;
        }else{
            return false;
        }

    }
    
    // public function advisors()
    // {
    //     return $this->belongsToMany('App\Models\User', 'App\Models\Users_roles','roles_id','users_id');
    // }

}
