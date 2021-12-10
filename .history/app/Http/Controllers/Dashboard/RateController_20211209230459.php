<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Store;

class RateController extends Controller
{
    
    public function index()
    {
        $stores = Store::with('rate')->with('category')->paginate(5);
        foreach ($stores as $store) {
            $store->is_trend = $this->lsq($store->id)??false;
        }
        // dd($stores);

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
        return redirect()->back()
                ->with('status', $result ? 'Thanks for rating' : 'You cant rate the same store twice');
    }

    private function lsq($store_id)
    {
        $rates_ordered = Rate::where('store_id', $store_id)->orderBy('created_at')->get()->toArray();

        if (sizeof($rates_ordered) > 1) {
            $X = array(); // created_at
            $Y = array(); // rate

            foreach ($rates_ordered as $rate) {
                $X[] = strtotime($rate['created_at']);
                $Y[] = (int)$rate['rate'];
            }

            $logX = array_map('log', $X);

            $n = count($X);
            $square = function ($x) {
                return pow($x, 2);
            };
            $x_squared = array_sum(array_map($square, $logX));

            $xy = array_sum(array_map(function ($x, $y) {
                return $x * $y;
            }, $logX, $Y));

            $bFit = ($n * $xy - array_sum($Y) * array_sum($logX)) /
                ($n * $x_squared - pow(array_sum($logX), 2));
            //$aFit = (array_sum($Y) - $bFit * array_sum($logX)) / $n;
            return $bFit > 0;
        }
        return true;
    }
}
