<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoryRequest;
use App\Http\Traits\UploadFileTrait;


class CategoryController extends Controller
{

    use UploadFileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withTrashed()->get();
        return view('dashboard.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {

            $result = false;

            $name = $request['name'];
            $path = $this->save_file($request, 'dashboard/categories/icons/');

            $category = new Category();
            $category->name = $name;
            $category->icon = ($path == null) ? '' : $path;

            $result = $category->save();
            // to catch uniqly rating 
        } catch (\Illuminate\Database\QueryException $ex) {
        }
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
        $category = Category::find($id);

        return view('dashboard.categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category_name = $request['name'];

        $path = $this->save_file($request, 'dashboard/categories/icons/');


        $category = Category::find($id);
        $category->name = $category_name;
        $category->icon = ($path == null) ? $category->icon : $path;
        $result = $category->save();

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
        $stores = Store::where('category_id', $id)->get();
        foreach($stores as $store){
         (new StoreController())->destroy($store->id);
        }
        $result = Category::find($id)->delete();
        return redirect()->back()->with('status', $result)->with('type', 'Delete');
    }


    public function restore($id)
    {
        $result = Category::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('status', $result)->with('type', 'Restore');
    }

    public function save_file(Request $request, $inital_path)
    {

        $status = false;

        if ($request->hasfile('icon')) {

            $icon = $request->file('icon');

            $path = $inital_path;

            $icon_name = time() + rand(1, 10000000000) . '.' . $icon->getClientOriginalExtension();

            Storage::disk('local')->put($path . $icon_name, file_get_contents($icon));

            $status = Storage::disk('local')->exists($path . $icon_name);
        }
        //file_exists()
        return $status ? $path . $icon_name : null;
    }
}
