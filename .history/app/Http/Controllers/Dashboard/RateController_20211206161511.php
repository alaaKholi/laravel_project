<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Store;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::with('rate')->with('category')->paginate(5);
        return view('dashboard.rates_review.rates_review')->with('stores', $stores);
    }

   
    public function add_rate(Request $request, $store_id)
    {
        try {

            $result = false;

            $store_rating =  $request->input('store_rating');
            $rate = new Rate();
            $rate->store_id = $store_id;
            $rate->rate = $store_rating;
            $rate->guest_ip = $request->ip();
            $result = $rate->save();

            // to catch uniqly rating 
        } catch (\Illuminate\Database\QueryException $ex) {
        }
        return redirect()->back()->with('status', $result ? 'Thanks for rating' : 'You cant rate the same store twice');
    }

   
}
