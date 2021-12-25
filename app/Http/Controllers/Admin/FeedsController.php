<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feed;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Helpers;

class FeedsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $feeds = Feed::with('category')
            ->with('items')
            ->orderBy('id', 'desc')->paginate(10);

        return view('admin.feeds', compact('feeds'));
    }

    public function create()
    {
        return view('admin.edit.edit_feeds');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'feed_name' => 'required',
            'feed_url' => 'required',
            'items_limit' => 'required',
            'update_rate' => 'required',
            'category_id' => 'required',
            'feed_logo' => 'required|image|mimes:jpeg,jpg,png,gif|max:5000'
        ]);

        $feed = new Feed();
        // upload logo and get the path to it
        $feed_logo = Helpers\ImageUploader::img_upload($request, 'feed', $feed, 'insert');

        $feed->feed_name = $request->feed_name;
        $feed->url = $request->feed_url;
        $feed->items_limit = $request->items_limit;
        if ($request->cron_job == 1) {
            $feed->cron_update = $request->cron_job;
        } else {
            $feed->cron_update = 0;
        }
        $feed->update_rate = $request->update_rate;
        $feed->category_id = $request->category_id;
        $feed->logo = $feed_logo;
        $feed->save();

        return redirect()->action('Admin\FeedsController@index')->with('success', 'New Feed Source Created');
    }

    public function show($feed_id)
    {
        $feed_items = Item::with('category')
            ->with('feed')
            ->where('feed_id', '=', $feed_id)
            ->orderBy('id', 'desc')->get();

        $feed_name = Feed::where('id', '=', $feed_id)->first();

        return view('admin.feed_items', compact('feed_items', 'feed_name'));
    }


    public function edit(Feed $feed)
    {
        $edit_feed = $feed;
        return view('admin.edit.edit_feeds', compact('edit_feed'));
    }

    public function update(Request $request, Feed $feed)
    {
        $this->validate($request, [
            'feed_name' => 'required',
            'feed_url' => 'required',
            'items_limit' => 'required',
            'update_rate' => 'required',
            'category_id' => 'required',
            'feed_logo' => 'image|mimes:jpeg,jpg,png,gif|max:5000'
        ]);

        $feed_logo = Helpers\ImageUploader::img_upload($request, 'feed', $feed, 'update');

        if ($feed_logo == '')// if didn't select a new image
        {
            $feed_logo = $feed->logo; // choose the saved img url in DB
        }


        $feed->feed_name = $request->feed_name;
        $feed->url = $request->feed_url;
        $feed->items_limit = $request->items_limit;

        if ($request->cron_job == 1) {
            $feed->cron_update = $request->cron_job;
        } else {
            $feed->cron_update = 0;
        }

        $feed->update_rate = $request->update_rate;
        $feed->category_id = $request->category_id;
        $feed->logo = $feed_logo;
        $feed->save();
        return redirect()->action('Admin\FeedsController@index')
            ->with('success', 'Feed Source: "' . $feed->feed_name . '" Updated');
    }


    public function destroy(Feed $feed)
    {
        try {

            $feed->delete();

            $old_feed_logo = 'storage/uploads/images/feeds/' . $feed->logo; // get previous logo from folder

            if (File::exists($old_feed_logo)) { // remove feed logo from folder
                unlink($old_feed_logo);
            }

            $feed_items = Item::where('feed_id', 'like', $feed->id)->get();

            foreach ($feed_items as $feed_item) {

                if ($feed_item->thumbnail != '') {

                    $old_thumbnail = 'storage/uploads/images/items/' . $feed_item->thumbnail; // get item thumbnail link from folder

                    if (File::exists($old_thumbnail)) { // remove item thumbnail from folder
                        unlink($old_thumbnail);
                    }
                }

                $feed_item->delete();
            }

        } catch (\Exception $e) {
            $e->getMessage();
        }
        return redirect()->back()->with('success', 'Feed Source Deleted');
    }
}
