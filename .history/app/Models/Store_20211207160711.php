<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function category(){
        return $this->belongsTo('App\Models\Category'); 
     }
     public function rate(){
        return $this->hasMany('App\Models\Rate'); 
     }

     public function lsq()
    {
        $rates_ordered = Rate::where('store_id', $this->id)->orderBy('created_at')->get()->toArray();

        $X = array(); // created_at
        $Y = array(); // rate

        foreach ($rates_ordered as $rate) {
            $X[] = strtotime($rate['created_at']);
            $Y[] = (int)$rate['rate'];
        }
        //dd($X);
        //dd($Y);

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
        // echo ' intercept ',$aFit,'    ';
        // echo ' slope ',$bFit,'   ' ; 

        return $bFit > 0;

        // $Yfit = array();
        // foreach ($X as $x) {
        //     $Yfit[] = $aFit + $bFit * log($x);
        // }


    }
}
