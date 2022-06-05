<?php

function checkPromotion($promotion = [], $price) {
    $dataProducts = [];
    $now = time(); // or your date as well
    $end_date = strtotime($promotion->end_date);
    $start_date = strtotime($promotion->start_date);
    $datediff = $end_date - $now;
    $effective = round($datediff / (60 * 60 * 24)) + 1;
    $dataProducts['promotion'] = 0;
    if($effective > 0) {
        if($start_date < $now && $end_date > $now) {
            $percent_promotion = $promotion->percent;
            $percent = $percent_promotion / 100;
            $price_promotion = $percent * $price;
            $promotion_pr =  $price - $price_promotion;
            $dataProducts['promotion'] = ceil($promotion_pr);
            $dataProducts['percent_promotion'] = $percent_promotion;
        }
    }
    return $dataProducts;
}