<?php


namespace App\Services;

use App\Models\Feed;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class InitFeeds
{
    public static function getFeedData()
    {
        $feeds = Feed::where('cron_update', '=', 1)->get();

        foreach ($feeds as $row) {

            $cron_update = $row['cron_update'];
            if ($cron_update) {
                $last_update = $row['last_update'] + $row['update_rate'];
                if (true) {
                    //$last_update > time()
                    $category_id = $row['category_id'];
                    $feed_id = $row['id'];
                    $feed_url = $row['url'];
                    $feed_items = $row['items_limit'];


                    $simplepie = new \SimplePie();
                    $simplepie->set_feed_url($feed_url);
                    $simplepie->strip_htmltags(false);
                    $simplepie->init();

                    //to get the last items on the feed source limited with "items_limit" value from DB
                    $items_array = $simplepie->get_items(0, $feed_items);

                    $simplepie->enable_cache(false);
                    $simplepie->set_cache_duration(3600);
                    $simplepie->set_cache_location(public_path('cache'));
                    $simplepie->handle_content_type();

                    // loop through the items
                    foreach ($items_array as $item) {
                        //get each item link
                        $item_link = $item->get_permalink();

                        $title = htmlspecialchars($item->get_title(), ENT_QUOTES);
                        $description = $item->get_content();
                        $datetime = time();
                        if (InitFeeds::check_item_url($item_link, $title) == 0) {
                            if ($enclosure = $item->get_enclosure()) {
                                $image = $enclosure->get_link();
                                if (empty($image)) {
                                    $image = InitFeeds::get_item_image($item->get_content());
                                }
                            } else {
                                $image = InitFeeds::get_item_image($item->get_content());
                            }
                            if (!empty($image)) {

                                $img_type = substr(strrchr($image, '.'), 1);
                                $img_name = 'item_' . rand() . '.' . $img_type;
                                file_put_contents(storage_path('app/public/uploads/images/items/') . $img_name, file_get_contents($image));

                            } else {
                                $img_name = '';
                            }
                            $item = new Item();
                            $item->title = $title;
                            $item->url = $item_link;
                            $item->thumbnail = $img_name;
                            $item->description = $description;
                            $item->datetime = $datetime;
                            $item->category_id = $category_id;
                            $item->feed_id = $feed_id;
                            $item->save();
                        }
                    }

                    $feed = Feed::where('id', $feed_id)->first();
                    $feed->last_update = time();
                    $feed->save();
                }
            }

        }

    }


    static function check_item_url($url, $title)
    {
        return DB::table('items')
            ->where('url', '=', $url)
            ->where('title', '=', $title)
            ->count();

    }


    static function get_item_image($html)
    {
        require_once('simple_html_dom.php');
        $post_dom = str_get_html($html);
        $first_img = $post_dom->find('img', 0);
        if ($first_img !== null) {
            $image = $first_img->src;
            if (strtok($image, '?') != '') {
                $image = strtok($image, '?');
            } else {
                $image = $image;
            }
            return $image;
        }

        return null;

    }

}
