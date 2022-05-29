<?php
namespace App\Repositories\ImageProduct;

use App\Repositories\RepositoryInterface;

interface ImageProductRepositoryInterface extends RepositoryInterface
{
    public function insertImageProduct($array = []);
    public function selectImagesProduct($id);
}