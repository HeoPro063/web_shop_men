<?php
namespace App\Repositories\Color;

use App\Repositories\BaseRepository;

class ColorRepository extends BaseRepository implements ColorRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Color::class;
    }
    
  
}