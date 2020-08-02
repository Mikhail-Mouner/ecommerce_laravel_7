<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MainCategoriesController extends Controller
{ /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       return view('admin.categories.index')
        ->with('mainCategories', MainCategory::where('translation_lang',get_defualt_language()) ->selection()->get() );
   }
   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {
        try{
            DB::beginTransaction();
         
            $filter = collect($request->cat)->filter(function ($value,$key){
                return $value['translation_lang'] == get_defualt_language();
            });
            $default_cat = array_values($filter->all())[0];
            
            $file_path = $request->photo->store('maincategories','images');
            $default_cat = MainCategory::create([
                'translation_lang' => $default_cat['translation_lang'],
                'translation_of' => 0,
                'name' => $default_cat['name'],
                'slug' => Str::slug($default_cat['name'],'-'),
                'photo'=> $file_path
            ]);
            $default_cat_id = $default_cat->id;

            $filter = collect($request->cat)->filter(function($value,$key){
                return $value['translation_lang'] != get_defualt_language();
            });

            $remain_cats = array_values($filter->all());
            
            if (isset($remain_cats) && !empty($remain_cats) ){
                $categories=array();
                foreach ($remain_cats as $remain_cat) {
                    $categories[]=[
                        'translation_lang' => $remain_cat['translation_lang'],
                        'translation_of' => $default_cat_id,
                        'name' => $remain_cat['name'],
                        'slug' => Str::slug($remain_cat['name'],'-'),
                        'photo'=> $file_path
                    ];
                }
                MainCategory::insert($categories);
            }
            DB::commit();
            session()->flash('success','Insert was Successfully');
        }catch (\Exception $e){
            DB::rollback();
            session()->flash('error','Something Gone Wrong');
        }
        
        return redirect()->back();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categ = MainCategory::with('categories')->find($id);
        $returnHTML = view('admin.ajax.categories.edit',['categ'=> $categ])->render();// or method that you prefere to return data + RENDER is the key here
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MainCategoryRequest $request, $id)
    { 
        
        try{
            DB::beginTransaction();
            
        
            $categ = MainCategory::with('categories')->find($id);
            if ($request->has('photo')){
                $file_path = $request->photo->store('maincategories','images');
                $categ->photo = $file_path;
            }

            $categ->name = $request->cat[0]['name'];
            $categ->active = $request->cat[0]['active'];
            $categ->save();

            $remain_categs = MainCategory::select('id')->find($id)->categories;
            foreach ($remain_categs as $index => $remain_categ){
                if ($index ==0) continue;
                if ($request->has('photo'))
                    $remain_categ->photo = $file_path;

                $remain_categ->name = $request->cat[$index]['name'];
                $remain_categ->active = $request->cat[$index]['active'];
                $remain_categ->save();
            }

            session()->flash('success','Update was Successfully');
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            session()->flash('error','Something Gone Wrong');
        }
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $categ = MainCategory::find($id);    
            Storage::disk('images')->delete($categ->photo);
            $categ->delete();
            $categes = MainCategory::where('translation_of',$id)->delete();
            if ($categ->vendors()->count() > 0){
                $categ->vendors()->delete();
            }
        }catch(\Exception $e){
            return response()->json(['status'=>true,'error'=>true,'errors'=>$e]);
        }
        return response()->json(['status'=>true,'error'=>false]);
    }
}
