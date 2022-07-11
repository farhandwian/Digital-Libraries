<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\User;
use App\Anggota;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
                'level' => ['required', 'string'],
            ]);       
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
            return User::create([
                'name' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'level' => "user",
            ]);
        
        
    }

    // public function store(Request $request){
    //     $request->validate([
    //         'username' => 'required|max:25|unique:user',
    //         'email' => 'required|unique:user',
    //         'password' => 'required',
    //     ], [
    //         'required' => 'atribute tidak boleh kosong',
    //         'unique' => 'atribute sudah terdaftar',
    //         'max' => 'karakter max 25',
    //     ]);

    //     $password=Hash::make($request->password);

    //     User::create([
    //         'name'=>$request->username,
    //         'email'=>$request->email,
    //         'password'=>$password,
    //         'level'=>'user'
    //     ]);

    //     return redirect('/')->with('success', "Account successfully registered.");
    // }
}
