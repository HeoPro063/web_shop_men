<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Validators\ProductValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Repositories\Product\ProductRepositoryInterface; 
use App\Repositories\ImageProduct\ImageProductRepositoryInterface; 
use File;

use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\Promotion;
use App\Models\ProductColor;
use App\Models\ProductSize;

class ProductController extends Controller
{

    protected $product;
    protected $validator;
    protected $image_product;
    public function __construct(ProductRepositoryInterface $product, ProductValidator $validator, ImageProductRepositoryInterface $image_product)
    {
        $this->product = $product;
        $this->image_product = $image_product;
        $this->validator = $validator;
    }

    public function viewList() {
        return view('admin.pages.product.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $result =  $this->product->searchProduct($request->all());
        $dataProducts = [];
        foreach($result as $key => $item) {
            $dataProducts[$key]['id'] = $item->id;
            $dataProducts[$key]['name'] = $item->name;
            $dataProducts[$key]['price'] = $item->price;
            $dataProducts[$key]['quantity'] = $item->quantity;
            $dataProducts[$key]['promotion'] = null;
            if($item->promotion_id) {
               $promotion =  $this->product->find($item->id)->Promotion()->firstOrFail();
               $now = time(); // or your date as well
               $your_date = strtotime($promotion->end_date);
               $datediff = $your_date - $now;
               $effective = round($datediff / (60 * 60 * 24)) + 1;
                if($effective > 0) {
                    $percent_promotion = $promotion->percent;
                    $percent = $percent_promotion / 100;
                    $price_promotion = $percent * $item->price;
                    $promotion_pr =  $item->price - $price_promotion;
                    $dataProducts[$key]['promotion'] = $promotion_pr;
                    $dataProducts[$key]['percent_promotion'] = $percent_promotion;
                }else{
                    $dataProducts[$key]['promotion'] = 0;
                }
            }
        }
        $datas = [
            'paginate' => $result,
            'products' => $dataProducts,
        ];

        return response()->json([
            'status' => 200,
            'message' => 'Successfully',
            'datas' => $datas
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        $promotions = Promotion::all();

        return view('admin.pages.product.create', compact(['categories', 'sizes', 'colors', 'promotions']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        try {
            $this->validator->with($data)->passesOrFail(BaseValidatorInterface::RULE_CREATE);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 403,
                'message' => 'Bad request',
                'datas' => $e->getMessageBag()
            ]);
        }
       
        try {
            DB::beginTransaction();
            if($request->promotion_id){
                unset($data['promotion_id']);
            }
            $product = $this->product->create($data);
            $product_id = $product->id;
            $dataImage = [];
            if($request->hasFile('files')) {
                foreach($request->file('files') as $file) {
                    $file_ext = $file->getClientOriginalExtension();
                    if(!in_array($file_ext, EXPENSIONS)) {
                        return response()->json([
                            'status' => 403,
                            'message' => 'Image not found',
                        ]);
                    }
                }
                foreach($request->file('files') as $key => $file) {
                    $filename =   time().rand(1,100). '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'),$filename);
                    $dataImage[$key] = [
                        'product_id' => $product_id,
                        'name' => $filename
                    ];
                }
                $this->image_product->insertImageProduct($dataImage);
            }
            foreach($request->color_ids as $key => $color_id) {
                $ProductColor = new ProductColor;
                $ProductColor->product_id = $product_id;
                $ProductColor->color_id = intval($color_id);
                $ProductColor->save();
            }

            foreach($request->size_ids as $key => $size_id) {
                $ProductSize = new ProductSize;
                $ProductSize->product_id = $product_id;
                $ProductSize->size_id = intval($size_id);
                $ProductSize->save();
            }

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Created Successfully',
                'datas' => $product
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);
        if(!$product){
            return response()->json([
                'error' => 'product not found',
            ], 500);
        }
        return response()->json($this->reposeDataShow($product), 200);
    }

    public function reposeDataShow($product) {
        $data = [];
        $data['id'] = $product->id;
        $data['category_id'] = $product->category_id;
        $data['size_id'] = $product->size_id;
        $data['name'] = $product->name;
        $data['price'] = $product->price;
        $data['quantity'] = $product->quantity;
        $data['description'] = $product->description;
        $data['size_name'] = $product->Size->name;
        $data['images'] = [];
        foreach($product->ImageProducts as $key => $item) {
            $data['images'][$key] = $item->name;
        }
        return $data;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        $promotions = Promotion::all();

        $product = $this->product->find($id);
        $images = $product->ImageProducts()->get();
        $product_colors = $product->ProductColors()->get();
        $data_product_colors = [];
        foreach($product_colors as $key => $item) {
            $data_product_colors[$key] = $item->Color()->firstOrFail();
        }
        $product_sizes = $product->ProductSizes()->get();
        $data_product_sizes = [];
        foreach($product_sizes as $key => $item) {
            $data_product_sizes[$key] = $item->Size()->firstOrFail();
        }

        return view('admin.pages.product.edit', compact('product', 'images', 'categories', 'sizes', 'colors', 'promotions', 'data_product_colors', 'data_product_sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        try {
            $this->validator->with($data)->setId($id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 403,
                'message' => 'Bad request',
                'datas' => $e->getMessageBag()
            ]);
        }

        try {
            DB::beginTransaction();

            $data_colors = [];
            $data_sizes = [];
            if($data['colors']) {
                $data_colors = $data['colors'];
                unset($data['colors']);
            }

            if($data['sizes']) {
                $data_sizes = $data['sizes'];
                unset($data['sizes']);
            }
            $product = $this->product->update($id, $data);
            ProductColor::where('product_id', $id)->delete();
            ProductSize::where('product_id', $id)->delete();
            foreach($data_colors as $key => $color) {
                $ProductColor = new ProductColor;
                $ProductColor->product_id = $product->id;
                $ProductColor->color_id = $color['id'];
                $ProductColor->save();
            }
            foreach($data_sizes as $key => $size) {
                $ProductSize = new ProductSize;
                $ProductSize->product_id = $product->id;
                $ProductSize->size_id = $size['id'];
                $ProductSize->save();
            }

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'datas' => $product
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 403,
                'message' => 'Error updated',
                'datas' => $e
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $images = $this->image_product->selectImagesProduct($id);
        foreach($images as $item) {
            $path_image = 'uploads/'. $item->name;
            if(File::exists($path_image)) {
                File::delete($path_image);
            }
        }
        $this->image_product->deleteImagesProduct($id);
        $this->product->find($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'success',
        ]);
    }
}
