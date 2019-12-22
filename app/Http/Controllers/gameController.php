<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\addUserRequest;
use Illuminate\Support\Facades\Hash;

class gameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function game(Request $request){

    	if(Auth::user()->status ==0){
        	return view('game2');
    	}
    	else{
    		Auth::logout();

            $request->session()->flush();

            $request->session()->regenerate();
            return redirect('/login')->with(['flash_level'=>'danger','flash_message'=>'Mỗi mã tham gia chỉ được chơi 1 lần']);
    	}
    }
    public function finish($id){
    	if(Auth::user()->id ==$id){
	    	$user = User::where('id',$id)->get()->first();
	    	$user->status =1;
	    	$user->save();
	    }
	    else{
	    	return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Không được phép truy cập url này ']);
	    }
    }
    public function phanthuong($phanthuong){
    	if(Auth::user()->id && Auth::user()->status ==0){
    		$id = Auth::user()->id;
    		$user = User::where('id',$id)->get()->first();
    		$user->phanthuong = $phanthuong;
    		$user->save();
    		echo "thành công";
    	}
    	else{
    		return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Không được phép truy cập url này ']);
    	}
    }
    public function listUser(){
        if(Auth::user()->role ==1){
            $user = User::where('role',0)->get();
            return view('admin.listUser',['user'=>$user]);
        }
        else{
            return redirect('logout');
        }
    }
    public function addUser(){
        if(Auth::user()->role ==1){
            return view('admin.addUser');
        }
        else{
            return redirect('logout');
        }
    }
    public function postAddUser(addUserRequest $request){
        $user = new User;
        $user->name = $request->name;
        $user->sdt = $request->sdt;
        $user->password = Hash::make($request->sdt);
        $user->status = 0;
        $user->role = $request->role;
        $user->save();
        return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>' Thêm tài khoản thành công ']);
    }

}
