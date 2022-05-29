<?php
namespace App\Repositories\ImageProduct;

use App\Repositories\BaseRepository;

class ImageProductRepository extends BaseRepository implements ImageProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\ImageProduct::class;
    }
    
    public function insertImageProduct($array = []) {
        return $this->model->insert($array);
    }

    public function selectImagesProduct($id) {
        return $this->model->where('product_id', $id)->get();
    }
  
}