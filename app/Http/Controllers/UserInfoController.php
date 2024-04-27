<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    public function user_info(){
        return view('user_info.user_info');
    }
    public function overview_info(){
        $user_info=User::find(Auth::user()->id);
        return view('user_info.overview',[
            'user_info'=>$user_info,
        ]);
    }
    public function user_info_profile(){
        $user_info=User::find(Auth::user()->id);
        return view('user_info.profile',[
            'user_info'=>$user_info,
        ]);
    }
    public function user_info_profile_post(Request $request){
        $image=$request->image;
        $extension=$image->extension();
        $imageName = time().'.'.$extension;
        $image->move(public_path('upload/profile'), $imageName);
       User::find(Auth::user()->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'photo'=>$imageName,
        ]);
        return back()->with('success','User  Profile Updated');

    }
    public function user_info_profile_password(){
        return view('user_info.edit_password');
    }
}
