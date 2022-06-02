<?php
namespace App\Repositories\Promotion;

use App\Repositories\BaseRepository;

class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Promotion::class;
    }
    
  
}