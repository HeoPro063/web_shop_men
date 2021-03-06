<?php
namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getProduct();

    public function searchProduct($request = []);

    public function getProductHot();

    public function getProductDefault($request = []);

    public function getProductSearch($request = []);

    public function reposeDataDetail($product = []);

    public function getProductNews($limit);

    public function getMoreProduct($products);
}