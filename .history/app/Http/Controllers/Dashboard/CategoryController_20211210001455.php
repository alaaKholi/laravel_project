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

    public function index()
    {
        $categories = Category::withTrashed()->get();
        return view('dashboard.categories.index')->with('categories', $categories);
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


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
            // to catch uniqly category name
        } catch (\Illuminate\Database\QueryException $ex) {
        }
        return redirect()->back()->with('status', $result);
    }


    public function edit($id)
    {
        $category = Category::find($id);

        return view('dashboard.categories.edit')->with('category', $category);
    }

    
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

   
    public function destroy($id)
    {
        
        $result = Category::find($id)->delete();
        return redirect()->back()->with('status', $result)->with('type', 'Delete');
    }


    public function restore($id)
    {
         
        $result = Category::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('status', $result)->with('type', 'Restore');
    }

   
}
