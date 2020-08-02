<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function getLogin()
    {
        return view('admin.login');
    }
 
    public function login(LoginRequest $request)
    {
        $remeber = (boolval($request->rember_me))? true : false ;
        $admin = auth()->guard('admin')->attempt([ 'email' => $request->email, 'password' => $request->password ],$remeber);
        if ($admin)
            return redirect(route('admin.dashboard'));
        return redirect(route('admin.getLogin'));
            
    }

    public function logout()
    {
        Auth::logout();
    }
}
