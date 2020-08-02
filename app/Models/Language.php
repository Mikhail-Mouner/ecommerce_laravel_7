<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //protected $table = 'languages';
    public $fillable = [ 'abbr' ,'local' ,'name' ,'direction' ,'active' ,'created_at' ,'updated_at'  ];
    //public $guarded = [ '' ];
    //public $hidden = [ '' ];
    //public $timestamps = false;
    
    /*****   ***************   *****/
    /*****   Start Accessors   *****/
    public function getActiveAttribute($value)
    {
        return $value==1?'Active':'Not Active';
    }
    public function getDirectionAttribute($value)
    {
        return $value=='rtl'?'Right To Left':'Left To Right';
    }
    /*****   /End  Accessors   *****/
    /*****   ***************   *****/
    
    /*****   ***************   *****/
    /*****   Start Mutators   *****/
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
        return $query->select('id', 'abbr', 'name', 'direction');
    }

    /*****   /End  Local scope   *****/
    /*****   ***************   *****/
    
    /*****   ***************   *****/
    /*****   Start Relation   *****/
    /*****   /End Relation   *****/
    /*****   ***************   *****/
}
