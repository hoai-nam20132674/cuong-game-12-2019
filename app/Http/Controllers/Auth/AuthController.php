<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\loginRequest;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $redirectPath = 'game/chi-an-khach-hang';
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function getLogin(){
        $user = Auth::user();
        if($user){
            return View('game');
        }
        
        else{
            return View('login');
        }
    }
    public function backLogin(){
        return redirect('login');
    }
    public function postLogin(loginRequest $request){
        $login =array(
            'sdt' =>$request->password,
            'password'=>$request->password
        );
        if(Auth::attempt($login) ){
            if(Auth::user()->role ==1){
                return redirect('game/admin/danh-sach-khach-hang');
            }
            if(Auth::user()->status ==0){
                return redirect('game/qua-giang-sinh');
            }
            else{
                Auth::logout();

                $request->session()->flush();

                $request->session()->regenerate();
                return redirect('/login')->with(['flash_level'=>'danger','flash_message'=>'Mỗi mã tham gia chỉ được chơi 1 lần']);
            }
        }
        else{
            return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Mã tham gia không chính xác']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');
    }
}
