<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Validators\ProductValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Repositories\Product\ProductRepositoryInterface; 
use App\Repositories\ImageProduct\ImageProductRepositoryInterface; 

use Illuminate\Support\Facades\DB;
use Exception;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data =  $this->product->searchProduct($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Successfully',
            'datas' => $result
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
            $product = $this->product->create($data);
            $product_id = $product->id;
            // sử lý image
            // vd: data image 
            $data_img = ['abc.PNG', 'abc.jpg', 'abc.jpeg'];
            $array_ext = [];
            $data_2 = [];
            $expensions= array();
            foreach($data_img as $key => $item) {
                $file_parts = explode('.',$item);
                $file_ext = strtolower(end($file_parts));
                $array_ext[$key] = $file_ext;
                if(!in_array($file_ext, EXPENSIONS)) {
                    return response()->json([
                        'status' => 403,
                        'message' => 'Image not found',
                    ]);
                }
                $data_2[$key] = [
                    'product_id' => $product_id,
                    'name' => $item
                ];
            }
            $this->image_product->insertImageProduct($data_2);
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
            return response()->json($e, 403);
        }

        $product = $this->product->update($id, $data);
        if(!$product) {
            return response()->json(['error' => 'Product not found'], 500);
        }

        return response()->json($product, 200);
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
        
    }
}
