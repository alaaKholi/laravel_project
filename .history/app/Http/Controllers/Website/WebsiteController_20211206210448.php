<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use App\Models\Rate;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function index()
    {


        return view('website.index');

    }
    public function showCategoryStores($id)
    {
   
        // $stores= Store::with('category')->with('rate')->where('category_id',$id)->get();
        // $rate=$stores->rate()->count();
        //$rate=Rate::with('store')->where('store_id',$id)->count('*');
       // $stores= Store::where('category_id',$id)->with('rate')->get();
        
       // $stores= Rate::with('store')->where()->count('*');
       
       $stores= Store::with('rate')->where('category_id',$id)->get();
    //    $stores= Store::with('category')->with('rate')->where('category_id',$id)->select('*', DB::raw('count(*) as total'))->groupBy('id')
    //    ->orderBy('total', 'DESC')
    //    ->limit(3)->get();

    //    $latestPaymentWithTrendingProduct = Store::with(['rate', function($product) {
    //     $product->orderBy('rate', 'DESC')->take(4);
    //   }])->whereMonth('created_at', date('m'))->get()->groupBy('id');

    // $trendingProducts = Product::withCount(['payments' => function($query) { 
    //     $query->whereMonth('created_at', Carbon::now()->month); 
    // }])->orderBy('payments_count', 'DESC')->take(4)->get(); 

    // $trendingProducts = Product::withCount(['payments' => function($query) 
    // { $query->whereMonth('created_at', Carbon::now()->month); }])
    // ->orderBy('payments_count', 'DESC')->take(4)->get();

    // https://stackoverflow.com/questions/63552998/trending-query-laravel
        return view('website.category_stores.index')->with('stores',$stores);//->with('latestPaymentWithTrendingProduct',$latestPaymentWithTrendingProduct);

    }


    public function search()
    {
        $search=request()->query('search');
        if($search){
           $stores= Store::where('name','LIKE','%'.$search.'%')->paginate(8);
        }
   
        return view('website.category_stores.search')->with('stores',$stores);

    }

}
