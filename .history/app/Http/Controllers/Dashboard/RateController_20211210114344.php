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
            $store->is_trend = $this->lsq($store->id);
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
        // dd($rates_ordered);
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
            //dd((pow(array_sum($logX), 2)));

            $bFit = ($n * $xy - array_sum($Y) * array_sum($logX)) /
                ($n * $x_squared - pow(array_sum($logX), 2));
            $aFit = (array_sum($Y) - $bFit * array_sum($logX)) / $n;
            echo ' intercept ', $aFit, '    ';
            echo ' slope ', $bFit, '   ';
            return $bFit > 0;
        }
        return true;
    }

    function lsq2($store_id)
    {
        $rates_ordered = Rate::where('store_id', $store_id)->orderBy('created_at')->get()->toArray();

        if (sizeof($rates_ordered) > 1) {
            $X = array(); // created_at
            $Y = array(); // rate

            foreach ($rates_ordered as $rate) {
                $X[] = strtotime($rate['created_at']);
                $Y[] = (int)$rate['rate'];
            }
            // Now estimate $a and $b using equations from Math World
            $n = count($X);

            $mult_elem = function ($x, $y) { //anon function mult array elements 
                $output = $x * $y; //will be called on each element
                return $output;
            };

            $sumX2 = array_sum(array_map($mult_elem, $X, $X));

            $sumXY = array_sum(array_map($mult_elem, $X, $Y));
            $sumY = array_sum($Y);
            $sumX = array_sum($X);

            $bFit = ($n * $sumXY - $sumY * $sumX) /
                ($n * $sumX2 - pow($sumX, 2));
            $aFit = ($sumY - $bFit * $sumX) / $n;
            echo ' intercept ', $aFit, '    ';
            echo ' slope ', $bFit, '   ';

            //r2
            $sumY2 = array_sum(array_map($mult_elem, $Y, $Y));
            $top = ($n * $sumXY - $sumY * $sumX);
            $bottom = ($n * $sumX2 - $sumX * $sumX) * ($n * $sumY2 - $sumY * $sumY);
            $r2 = pow($top / sqrt($bottom), 2);
            echo '  r2  ', $r2;
            return $bFit > 0;
        }
        return true;
    }
}
