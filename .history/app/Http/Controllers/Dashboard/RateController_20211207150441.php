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
    public function lsq()
    {
        $rates_ordered= Rate::all();
        $rates= Rate::select('rate')->where('store_id','1')->orderBy('created_at')->get();
        
        dd($rates_ordered);
        $X = array(1,2,3,4,5);
        $Y = array(.3,.2,.7,.9,.8);
    
        $logX = array_map('log', $X);

        $n = count($X);
        //   $square = create_function('$x', 'return pow($x,2);');
        $square = function ($x) {
            return pow($x, 2);
        };
        $x_squared = array_sum(array_map($square, $logX));
        // $xy = array_sum(array_map(create_function('$x,$y', 'return $x*$y;'), $logX, $Y));

        $xy = array_sum(array_map(function ($x, $y) {
            return $x * $y;
        }, $logX, $Y));

        $bFit = ($n * $xy - array_sum($Y) * array_sum($logX)) /
            ($n * $x_squared - pow(array_sum($logX), 2));

        $aFit = (array_sum($Y) - $bFit * array_sum($logX)) / $n;
        echo ' intercept ',$aFit,'    ';
        echo ' slope ',$bFit,'   ' ; 
        
        // $Yfit = array();
        // foreach ($X as $x) {
        //     $Yfit[] = $aFit + $bFit * log($x);
        // }
          
        
    }

    public function lssq()
    {
  
        Rate::select()->where('store_id','1')->orderBy('created_at');
        $X = array(1,2,3,4,5);
        $Y = array(.3,.2,.7,.9,.8);
    
        $logX = array_map('log', $X);

        $n = count($X);
        //   $square = create_function('$x', 'return pow($x,2);');
        $square = function ($x) {
            return pow($x, 2);
        };
        $x_squared = array_sum(array_map($square, $logX));
        // $xy = array_sum(array_map(create_function('$x,$y', 'return $x*$y;'), $logX, $Y));

        $xy = array_sum(array_map(function ($x, $y) {
            return $x * $y;
        }, $logX, $Y));

        $bFit = ($n * $xy - array_sum($Y) * array_sum($logX)) /
            ($n * $x_squared - pow(array_sum($logX), 2));

        $aFit = (array_sum($Y) - $bFit * array_sum($logX)) / $n;
        echo ' intercept ',$aFit,'    ';
        echo ' slope ',$bFit,'   ' ; 
        
        // $Yfit = array();
        // foreach ($X as $x) {
        //     $Yfit[] = $aFit + $bFit * log($x);
        // }
          
    }
          
        
    

   
}
