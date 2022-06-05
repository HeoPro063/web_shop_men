<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface; 
use App\Repositories\Product\ProductRepositoryInterface; 
class CategoryController extends Controller
{
    //
    protected $category;
    protected $product;
    public function __construct(CategoryRepositoryInterface $category, ProductRepositoryInterface $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function index(Request $request)  {
        $data_default =  $this->product->getProductDefault($request);
        $data_category = $this->category->getCategorySomeData();
        return view('frontend.pages.category', compact('data_default', 'data_category'));
    }

    public function search(Request $request) {
        $data_search =  $this->product->getProductSearch($request->all());
        return response()->json([
            'status' => 200, 
            'message' => 'Success',
            'datas' => $data_search
        ]);
    }
}
