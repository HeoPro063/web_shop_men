<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Models\Promotion;
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function getProduct()
    {
        return $this->model->select('name')->get();
    }

    public function searchProduct($request = []) {
        $query = $this->model->select('products.*');
        if(!empty($request['price_default'])) {
            $query->whereBetween('price', [0, $request['price_default']]);
        }
        if(!empty($request['starting_price']) && !empty($request['end_price'])) {
            if($request['starting_price'] < $request['end_price']) {
                $query->whereBetween('price', [$request['starting_price'], $request['end_price']]);
            }
        }
        if(!empty($request['category'])) {
            $query->where('category_id', $request['category']);
        }
        if(!empty($request['size'])) {
            $query->where('size_id', $request['size']);
        }
        if(!empty($request['search_key'])) {
            $query->where('products.name', 'like', '%'.$request['search_key'].'%');
        }
        if(!empty($request['sort'])) {
            if($request['sort'] != 'all') {
                if($request['sort'] == 'asc') {
                    $query->orderBy('products.price', 'ASC');
                }else {
                    $query->orderBy('products.price', 'DESC');
                }
            }
        }
        return $query->paginate(3);
    }

    public function getProductHot() {
        
    }

    public function getProductDefault() {
        $products = $this->model->orderBy('purchases', 'DESC')->get();
        return $this->responDataGet($products);
    }

    public function getProductSearch($request = []) {
        $query = $this->model->select('products.*');
        if($request['category'] != 'null') {
            $query->where('category_id', $request['category']);
        }
        if($request['sort'] != 'null') {
            if($request['sort'] == 'price_min') {
                $query->orderBy('products.price', 'ASC');
            }else {
                $query->orderBy('products.price', 'DESC');
            }
        }
        $products = $query->get();
        return $this->responDataGet($products);
    }

    public function responDataGet($products) {
        $datas = [];
        foreach($products as $key => $item) {
            $datas[$key]['id'] = $item->id;
            $datas[$key]['category_id'] = $item->category_id;
            $datas[$key]['name'] = $item->name;
            $datas[$key]['price'] = $item->price;
            $images = $item->ImageProducts()->get();      
            $datas[$key]['image'] = $images[0]->name;
            $datas[$key]['description'] = $item->description;
            $datas[$key]['purchases'] = $item->purchases;
            $datas[$key]['quantity'] = $item->quantity;
            foreach ($images as $key_img => $img) {
                $datas[$key]['data_images'][$key_img]['name'] = $img->name;
            }
            $datas[$key]['status_promotion'] = 0;
            if($item->promotion_id) {
                $promotion = $item->Promotion()->firstOrFail();
                $now = time(); // or your date as well
                $your_date = strtotime($promotion->end_date);
                $datediff = $your_date - $now;
                $effective = round($datediff / (60 * 60 * 24)) + 1;
                if($effective > 0) {
                    $datas[$key]['status_promotion'] = 1;
                    $percent_promotion = $promotion->percent;
                    $percent = $percent_promotion / 100;
                    $price_promotion = $percent * $item->price;
                    $promotion_pr =  $item->price - $price_promotion;
                    $datas[$key]['promotion'] = $promotion_pr;
                    $datas[$key]['percent_promotion'] = $percent_promotion;
                }
            }
            $colors = $item->ProductColors()->get();
            foreach ($colors as $key_color => $color) {
                $datas[$key]['data_colors'][$key_color]['id'] = $color->Color()->firstOrFail()->id;
                $datas[$key]['data_colors'][$key_color]['name'] = $color->Color()->firstOrFail()->name;
            }

            $sizes = $item->ProductSizes()->get();
            foreach($sizes as $key_size => $size) {
                $datas[$key]['data_sizes'][$key_size]['id'] = $size->Size()->firstOrFail()->id;
                $datas[$key]['data_sizes'][$key_size]['name'] = $size->Size()->firstOrFail()->name;
            }
        }
        return $datas;
    } 

    public function reposeDataDetail($product = []) {
        $datas = [];
        $datas['id'] = $product->id;
        $datas['name'] = $product->name;
        $datas['purchases'] = $product->purchases;
        $datas['price'] = $product->price;
        $datas['quantity'] = $product->quantity;
        $datas['description'] = $product->description;
        $datas['status_promotion'] = 0;
        if($product->promotion_id) {
            $promotion = Promotion::find($product->promotion_id);
            $data_promotion = checkPromotion($promotion, $product->price);
            if($data_promotion['promotion'] == 0){
                $datas['status_promotion'] = 0;
            }else{
                $datas['status_promotion'] = 1;
                $datas['price_promotion'] = $data_promotion['promotion'];
                $datas['percent'] = $data_promotion['percent_promotion'];
            }
        }
        $images = $product->ImageProducts()->get();
        foreach($images as $key => $image) {
            if($key == 0) {
                $datas['avatar_product'] = $image->name;
            }
            $datas['data_images'][$key]['name'] = $image->name;
        }

        $datascolor = $product->ProductColors()->get();
        foreach($datascolor as $key => $color) {
            $datas['data_colors'][$key]['id'] = $color->Color()->firstOrFail()->id;
            $datas['data_colors'][$key]['name'] = $color->Color()->firstOrFail()->name;
        }

        $datassize = $product->ProductSizes()->get();
        foreach($datassize as $key => $size) {
            $datas['data_sizes'][$key]['id'] = $size->Size()->firstOrFail()->id;
            $datas['data_sizes'][$key]['name'] = $size->Size()->firstOrFail()->name;
        }
        return $datas;
    }

    public function getProductNews($limit) {

        $product = $this->model->offset(0)->limit($limit)->orderBy('id', 'DESC')->get();
        return $this->responDataGet($product);
    }
   
}