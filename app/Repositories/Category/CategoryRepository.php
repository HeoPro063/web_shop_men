<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use DB;
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function getCategory()
    {
        return $this->model->select('name')->get();
    }

    public function getCategorySomeData() {
        
        $category = $this->model->all();
        $data = [];
        foreach ($category as $key=> $item) {
            $data[$key]['id'] =  $item->id;
            $data[$key]['count'] = count($item->Products()->get());
        }

        for ($i = 0; $i < count($data) - 1; $i++)
        {
            for ($j = $i + 1; $j < count($data); $j++) 
            {
                if ($data[$i]['count'] < $data[$j]['count']) 
                {
                    $tmp = $data[$j];
                    $data[$j] = $data[$i];
                    $data[$i] = $tmp; 
                }
            }
        }

        $data_new = [];
        for ($i = 0; $i < count($data); $i++) {
            if($data[$i] == 0){
                unset($data[$i]);
            }else{
                $data_new[$i] = $data[$i]['id'];
            }
            if(count($data_new) == 5) {
                break;
            }
        }
        $category = $this->model->whereIn('id', $data_new)->get();
        return $category;
    }
}