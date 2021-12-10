<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Store;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('website.index');
    }

    
    public function showCategoryStores($id)
    {
        $stores = Store::with('rate')->where('category_id', $id)->get();
        return view('website.category_stores.index')->with('stores', $stores);
    }


    public function search()
    {
        $search = request()->query('search');
        if ($search) {
            $stores = Store::where('name', 'LIKE', '%' . $search . '%')->paginate(8);
        }

        return view('website.category_stores.search')->with('stores', $stores);
    }
}
