<?php

namespace App\Http\Controllers;
use App\Koleksi;
use Session;
use Illuminate\Http\Request;


class CartController extends Controller
{
    //
    public function add(Request $request, $id)
    {
        if(isset($_COOKIE["shoes_size"])){
            $size=$_COOKIE["shoes_size"];
        }
        
        $product = Koleksi::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        // $cart = new Cart($oldCart);
        // $cart->add($product,$product->id,$size);
        // $request->session()->put('cart',$cart);
        return redirect()->route('cart.index');
    }
}
