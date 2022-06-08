<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
class PromotionController extends Controller
{
    //

    public function index() {
        $today = now();
        $promotion = Promotion::whereDate('start_date','<=', $today)
        ->whereDate('end_date','>=', $today)
        ->get();
        $datas = [];
        foreach($promotion as $key => $item) {
            $datas[$key]['id'] = $item->id;
            $datas[$key]['name'] = $item->name;
            $datas[$key]['start_date'] = $item->start_date->format('d-m-Y');
            $datas[$key]['end_date'] = $item->end_date->format('d-m-Y');
            $datas[$key]['percent'] = $item->percent;
            foreach($item->Products()->get() as $key2 => $item2) {
                $datas[$key]['product'][$key2]['id'] = $item2->id;
                $datas[$key]['product'][$key2]['name'] = $item2->name;
                $percent_promotion = $item->percent;
                $percent = $percent_promotion / 100;
                $price_promotion = $percent * $item2->price;
                $promotion_pr =  $item2->price - $price_promotion;
                $datas[$key]['product'][$key2]['price'] = $promotion_pr;
                $datas[$key]['product'][$key2]['image'] = $item2->ImageProducts()->first()->name;
            }
        }

        return view('frontend.pages.promotion', compact('datas'));
    }
}
