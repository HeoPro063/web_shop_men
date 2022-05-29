<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;

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
}