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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::withTrashed()->paginate(5);
        return view('dashboard.stores.index')->with('stores', $stores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('dashboard.stores.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {


        $path = $this->save_file($request, 'dashboard/stores/icons/');

        $store = new Store();
        $store->name = $request['name'];
        $store->icon = ($path == null) ? '' : $path;
        $store->address = $request['address'];
        $store->mobile = $request['mobile'];
        $store->email = $request['email'];
        $store->category_id = $request['category_id'];
        $result = $store->save();




        return redirect()->back()->with('status', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);

        $categories = Category::all();


        return view('dashboard.stores.edit')->with('store', $store)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $result = Store::find($id)->delete();
        return redirect()->back()->with('status', $result)->with('type', 'Delete');
    }


    public function restore($id)
    {

        $result = Category::find($id)!= null
            ? Store::withTrashed()->where('id', $id)->restore()
            : false;
        return redirect()->back()->with('status', $result)->with('type', 'Restore');
    }



    public function search()
    {
        $search = request()->query('search');
        if ($search) {
            $stores = Store::where('name', 'LIKE', '%' . $search . '%')->paginate(2);
        }

        return view('dashboard.stores.search')->with('stores', $stores);
    }
}
