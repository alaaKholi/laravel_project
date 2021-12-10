<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Category;
use App\Http\Requests\StoreRequest;
use App\Http\Traits\UploadFileTrait;

class StoreController extends Controller
{

    use UploadFileTrait;


    public function index()
    {
        $stores = Store::withTrashed()->with('category')->paginate(5);
        return view('dashboard.stores.index')->with('stores', $stores);
    }


    public function create()
    {
        $categories = Category::all();

        return view('dashboard.stores.create')->with('categories', $categories);
    }


    public function store(StoreRequest $request)
    {


        $path = $this->save_file($request, 'dashboard/stores/icons/');

        $store = new Store();
        $store->name = $request['name'];
        $store->icon = $path;
        $store->address = $request['address'];
        $store->mobile = $request['mobile'];
        $store->email = $request['email'];
        $store->category_id = $request['category_id'];
        $result = $store->save();

        return redirect()->back()->with('status', $result);
    }


    public function edit($id)
    {
        $store = Store::find($id);

        $categories = Category::all();


        return view('dashboard.stores.edit')->with('store', $store)->with('categories', $categories);
    }


    public function update(StoreRequest $request, $id)
    {

        $path = $this->save_file($request, 'dashboard/stores/icons/');

        $store = Store::find($id);
        $store->name = $request['name'];
        $store->icon = ($path == null) ? $store->icon : $path;
        $store->address = $request['address'];
        $store->mobile = $request['mobile'];
        $store->email = $request['email'];
        $store->category_id = $request['category_id'];
        $result = $store->save();


        return redirect()->back()->with('status', $result);
    }

    
    public function destroy($id)
    {

        $result = Store::find($id)->delete();
        return redirect()->back()->with('status', $result)->with('type', 'Delete');
    }


    public function restore($id)
    {

        $result = Store::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('status', $result)->with('type', 'Restore');
    }



    public function search()
    {
        $search = request()->query('search');
        if ($search) {
            $stores = Store::where('name', 'LIKE', '%' . $search . '%')->with('category')->paginate(5);
        }

        return view('dashboard.stores.search')->with('stores', $stores);
    }
}
