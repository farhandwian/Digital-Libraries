<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
class RegisterController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'username' => 'required|max:25|unique:user',
            'email' => 'required|unique:user',
            'password' => 'required',
        ], [
            'required' => 'atribute tidak boleh kosong',
            'unique' => 'atribute sudah terdaftar',
            'max' => 'karakter max 25',
        ]);

        $password=Hash::make($request->password);

        User::create([
            'name'=>$request->username,
            'email'=>$request->email,
            'password'=>$password,
            'level'=>'user'
        ]);

        return redirect('/')->with('success', "Account successfully registered.");
    }
}
