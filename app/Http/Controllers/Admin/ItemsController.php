<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Helpers;
use Illuminate\Support\Facades\File;


class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Item::with('category')
            ->with('feed')
            ->orderBy('id', 'desc')->simplePaginate(10);

        return view('admin.items', compact('items'));
    }


    public function create()
    {
        return view('admin.edit.edit_items');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'item_title' => 'required',
            'item_description' => 'required',
            'category_id' => 'required',
            'item_thumbnail' => 'required|image|mimes:jpeg,jpg,png,gif|max:5000',
            'item_url' => 'required'
        ]);

        $item = new Item();
        // upload logo and get the path to it
        $item_thumbnail = Helpers\ImageUploader::img_upload($request, 'item', $item, 'insert');


        $item->title = $request->item_title;
        $item->description = $request->item_description;
        $item->category_id = $request->category_id;
        $item->feed_id = $request->feed_id;
        $item->url = $request->item_url;
        $item->thumbnail = $item_thumbnail;
        if ($request->published == 1){
            $item->published = $request->published;
        }else{
            $item->published = 0;
        }
        $item->save();

        return redirect()->action('Admin\ItemsController@index')->with('success', 'New Item Created');

    }

    public function show(Item $item)
    {
        //
    }

    public function edit(Item $item)
    {
        $edit_item = $item;
        return view('admin.edit.edit_items', compact('edit_item'));
    }


    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'item_title' => 'required',
            'item_description' => 'required',
            'category_id' => 'required',
            'item_thumbnail' => 'image|mimes:jpeg,jpg,png,gif|max:5000',
            'item_url' => 'required'
        ]);

        // upload image and get the path to it
        $item_thumbnail = Helpers\ImageUploader::img_upload($request, 'item', $item, 'update');

        if ($item_thumbnail == '')// if didn't select a new image
        {
            $item_thumbnail = $item->thumbnail; // choose the saved img url in DB
        }

        $item->title = $request->item_title;
        $item->description = $request->item_description;
        $item->category_id = $request->category_id;
        $item->feed_id = $request->feed_id;
        $item->url = $request->item_url;
        $item->thumbnail = $item_thumbnail;
        if ($request->published == 1){
            $item->published = $request->published;
        }else{
            $item->published = 0;
        }
        $item->save();
        return redirect()->action('Admin\ItemsController@index')->with('success', 'Item Updated');
    }

    public function destroy(Item $item)
    {
        try {

            $item->delete();

            $old_item_photo = 'storage/uploads/images/items/' . $item->thumbnail; // get previous logo from folder

            if (File::exists($old_item_photo)) { // remove previous logo from folder
                unlink($old_item_photo);
            }

        } catch (\Exception $e) {
            $e->getMessage();
        }
        return redirect()->back()->with('success', 'Item Deleted');
    }

}
