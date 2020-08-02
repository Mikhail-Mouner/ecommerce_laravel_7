<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MainCategory;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;
    //protected $table = 'venders';

    public $fillable = ['name', 'mobile', 'photo', 'address', 'email', 'password', 'category_id', 'active', 'lat', 'long'] ;

    //public $guarded = [ '' ];
    
    public $hidden = [ 'category_id', 'password' ];
    
    //public $timestamps = false;
    
    /*****   ***************   *****/
    /*****   Start Accessors   *****/
    public function getActiveAttribute($value)
    {
        return $value==1?'Active':'Not Active';
    }
    /*****   /End  Accessors   *****/
    /*****   ***************   *****/
    
    /*****   ***************   *****/
    /*****   Start Mutators   *****/
    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
    /*****   /End  Mutators   *****/
    /*****   ***************   *****/
    
    /*****   ***************   *****/
    /*****   Start Local scope   *****/
    public function scopeActive($query)
    {
        return $query->where('active' ,1);
    }
    
    public function scopeSelection($query)
    {
        return $query->select('name', 'mobile', 'photo', 'address', 'email',  'category_id', 'active');
    }
    /*****   /End  Local scope   *****/
    /*****   ***************   *****/
    
    /*****   ***************   *****/
    /*****   Start Relation   *****/
    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class,'category_id','id');
    }
    /*****   /End Relation   *****/
    /*****   ***************   *****/
}
