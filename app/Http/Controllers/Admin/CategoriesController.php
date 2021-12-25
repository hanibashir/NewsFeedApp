<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cats = Category::with('feeds')
            ->with('items')
            ->orderBy('id', 'desc')->paginate(10);

        return view('admin.categories', compact('cats'));
    }


    public function create()
    {
        return view('admin.edit.edit_cats');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'cat_name' => 'required',
            'cat_logo' => 'required|image|mimes:jpeg,jpg,png,gif|max:5000'
        ]);

        $cat = new Category();

        // upload logo and get the path to it
        $cat_logo = Helpers\ImageUploader::img_upload($request, 'cat', $cat, 'insert');

        $cat->name = $request->cat_name;
        $cat->logo = $cat_logo;
        $cat->save();
        return redirect()->action('Admin\CategoriesController@index')->with('success', 'New Feed Category Created');
    }


    public function show($cat_id)
    {
        $cat_items = Item::with('category')
            ->with('feed')
            ->where('category_id', '=', $cat_id)
            ->orderBy('id', 'desc')->get();

        $cat_name = Category::where('id', '=', $cat_id)->first();

        return view('admin.cat_items', compact('cat_items', 'cat_name'));
    }


    public function edit(Category $category)
    {
        $edit_cat = $category;
        return view('admin.edit.edit_cats', compact('edit_cat'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'cat_name' => 'required',
            'cat_logo' => 'required|image|mimes:jpeg,jpg,png,gif|max:5000'
        ]);

        $cat_logo = Helpers\ImageUploader::img_upload($request, 'cat', $category, 'update');

        if ($cat_logo == '')// if didn't select a new image
        {
            $cat_logo = $category->logo; // choose the saved img url in DB
        }


        $category->name = $request->cat_name;
        $category->logo = $cat_logo;
        $category->save();
        return redirect()->action('Admin\CategoriesController@index')->with('success', 'Category ' . $category->name . ' Updated');
    }

    public function destroy(Category $category)
    {
        try {

            $category->delete();

            $old_cat_logo = 'storage/uploads/images/cats/' . $category->logo; // get previous logo from folder

            if (File::exists($old_cat_logo)) { // unlink or remove previous logo from folder
                unlink($old_cat_logo);
            }

        } catch (\Exception $e) {
            $e->getMessage();
        }
        return redirect()->back()->with('success', 'Category Deleted');
    }

}
