<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use App\Models\Product;
use App\Repositories\ImageProduct\ImageProductRepositoryInterface; 
use Illuminate\Support\Facades\DB;

class ImageProductController extends Controller
{
    protected $imageProduct;

    public function __construct(ImageProductRepositoryInterface $imageProduct)
    {
        $this->imageProduct = $imageProduct;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
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

        try {
            DB::beginTransaction();
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
                        'product_id' => $request->product_id,
                        'name' => $filename
                    ];
                }
            }
            $images = $this->imageProduct->insertImageProduct($dataImage);
            $product = Product::find($request->product_id);
            $imagesData = $product->ImageProducts()->get();
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Created Successfully',
                'datas' => $imagesData
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
        //
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
        $image = $this->imageProduct->find($id);
        $path_image = 'uploads/'. $image->name;
        if(File::exists($path_image)) {
            File::delete($path_image);
            $image->delete();
            return response()->json([
                'status' => 200,
                'message' => 'success',
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => 'Not Found',
        ]);
    }
}
