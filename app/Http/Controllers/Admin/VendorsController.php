<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Models\Vendor;
use App\Http\Requests\VendorRequest;
use App\Notifications\VendorCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.vendors.index')
        ->with('vendors', Vendor::all())
        ->with('maincategories', MainCategory::where('translation_of','0')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        try{
            $file_path = $request->photo->store('vendors','images');
            $vendor = Vendor::create([
                'name' => $request->name,
                'password' => $request->password,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'email' => $request->email,
                'category_id' => $request->category_id,
                'photo'=> $file_path,
                'lat'=> $request->lat,
                'long'=> $request->long
            ]);
            Notification::send($vendor,new VendorCreated($vendor));
            session()->flash('success','Insert was Successfully');
        }catch (\Exception $e){
            session()->flash('error','Something Gone Wronge <br />'.$e);
        }
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        $returnHTML = view('admin.ajax.vendor.edit',[ 'vendor'=> $vendor, 'categories'=> MainCategory::where('translation_of','0')->get() ])->render();// or method that you prefere to return data + RENDER is the key here
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $id)
    {
        try{
            $vendor = Vendor::find($id);
            if ($request->has('photo')){
                $file_path = $request->photo->store('vendors','images');
                $vendor->photo = $file_path;
            }
            if ($request->has('password')){
                $vendor->password = $request->password;
            }

            $vendor->name = $request->name;
            $vendor->active = $request->active;
            $vendor->mobile = $request->mobile;
            $vendor->address = $request->address;
            $vendor->email = $request->email;
            $vendor->category_id = $request->category_id;
            $vendor->lat = $request->lat;
            $vendor->long = $request->long;
            $vendor->save();

            session()->flash('success','Update was Successfully');
        }catch (\Exception $e){
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
        $vendor=Vendor::find($id);            
        Storage::disk('images')->delete($vendor->photo);
        $vendor->delete();
        return response()->json(['status'=>true,'error'=>false]);
    }
}
