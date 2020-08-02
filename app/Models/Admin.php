<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    //protected $table = 'admins';
    
    public $fillable = [ 'name' ,'email' ,'photo' ,'password' ,'created_at' ,'updated_at'  ];
    
    //public $guarded = [ '' ];
    
    public $hidden = [ 'password', 'remember_token' ];
    
    //public $timestamps = false;
    
    /*****   Start Relation   *****/
    /*****   /End Relation   *****/

}
