<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface; 
use App\Models\Category;
use App\Models\Product;
class HomeController extends Controller
{
    //

    protected $product;
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    public function index() {
        return view('frontend.pages.home');
    }

    public function getDataNew(Request $request) {
        $limit = $request->get('limit');
        $dataNew = $this->product->getProductNews($limit);
        return response()->json([
            'status' => '200',
            'message' => 'success',
            'datas' => $dataNew
        ]);
    }
    public function about() {
        return view('frontend.pages.about');
    }

    public function getHeaderCategory() {
        $Category = Category::all();
        $counts = [];
        foreach ($Category as $key => $value) {
            $counts[$key]['id'] =  $value->id;
            $counts[$key]['count'] =  count($value->Products()->get());
        }

        for ($i = 0; $i < count($counts) - 1; $i++)
        {
            for ($j = $i + 1; $j < count($counts); $j++)
            {
                if ($counts[$i]['count'] < $counts[$j]['count']) 
                {
                    $tmp = $counts[$j];
                    $counts[$j] = $counts[$i];
                    $counts[$i] = $tmp;
                }
            }
        }
        $datas = [];
        for ($i=0; $i < 4; $i++) { 
            $datas[$i] = Category::find($counts[$i]['id']);
        }
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'datas' => $datas
        ]);
    }
}
