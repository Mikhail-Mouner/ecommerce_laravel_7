<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;

class MainCategory extends Model
{
    //protected $table = 'main_categories';

    public $fillable = [ 'translation_lang' ,'translation_of' ,'name' ,'slug' ,'photo' ,'active' ,'created_at' ,'updated_at'  ];

    //public $guarded = [ '' ];
    
    //public $hidden = [ '' ];
    
    //public $timestamps = false;
    
    public function activeValue()
    {
        return $this->active == 'Active' ? 1 : 0 ;
    }

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
        return $query->select('id' ,'translation_lang' ,'translation_of' ,'photo' ,'name' ,'slug' ,'active');
    }
    /*****   /End  Local scope   *****/
    /*****   ***************   *****/
    
    /*****   ***************   *****/
    /*****   Start Observer   *****/
    protected static function boot()
    {
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }
    /*****   /End Observer   *****/
    /*****   ***************   *****/
    
    /*****   ***************   *****/
    /*****   Start Relation   *****/
    public function categories()
    {
        return $this->hasMany(self::class,'translation_of','id');
    }
    
    public function vendors()
    {
        return $this->hasMany(Vendor::class,'category_id');
    }
    /*****   /End Relation   *****/
    /*****   ***************   *****/
}
