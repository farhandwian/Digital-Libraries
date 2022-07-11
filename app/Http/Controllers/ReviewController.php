<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use App\Transaksi;
use App\Review;
use App\Biblio;
class ReviewController extends Controller
{
    public static function checkReview($biblio){
          
        if(auth()->check()){
            if(Anggota::where('user_id',auth()->user()->id)->exists()??false){
                $anggota = Anggota::firstWhere('user_id', auth()->user()->id);
                $is_review = Review::where([['biblio_id','=',$biblio->id],['anggota_id','=',$anggota->id]])->count();
                if(!$is_review){
                    return true;
                }
            }
        }else{
            return false;
        }
    }

    public function store(Request $request,Biblio $biblio){
        //validate data
        $anggota = Anggota::firstWhere('user_id', auth()->user()->id);
        $validatedData = $request->validate([
            'comment'=>'required|max:500',
            'rating'=>'required',
        ]);

        //get order id
        $anggota = Anggota::firstWhere('user_id', auth()->user()->id);
        //$order=Order::where([['property_id','=',$biblio->id],['buyer_id','=',$anggota->id],['status','=','paid']])->first();
        //$order_id=$order->id;

        //$validatedData['order_id']=$order_id;
        $validatedData['anggota_id']=$anggota->id;
        $validatedData['biblio_id']=$biblio->id;

        //$order->status="reviewed";
        //$order->save();

        if ($biblio->rating != 0 && $biblio->total_reviewer != 0) {
            //proses memasukan nilai rating dan total_reviewer ke tabel properti
            $old_total_reviewer=$biblio->total_reviewer;
            //kali rating dan total_review di tabel biblio
            $old_rating_biblio=($biblio->rating)*$old_total_reviewer;
            //new daftar
            $new_rating_biblio=($old_rating_biblio+$validatedData['rating'])/($old_total_reviewer+1);
            $new_total_reviewer=$biblio->total_reviewer+1;
            //dd($old_total_reviewer,$old_rating_biblio,$new_rating_biblio,$new_total_reviewer);

            //masukin ke tabel biblio
            $biblio->total_reviewer=$new_total_reviewer;
            $biblio->rating=$new_rating_biblio;
        } else {
            $biblio->rating = $validatedData['rating'];
            $biblio->total_reviewer = 1;
        }
        //save tabel biblio
        $biblio->save();

        //create
        Review::create($validatedData);

        return redirect()->back()->with('success', 'Telah berhasil menambahkan ulasan.');
    }
}
