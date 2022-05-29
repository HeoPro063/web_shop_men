<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Validators\CategoryValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Repositories\Category\CategoryRepositoryInterface; 

class CategoryController extends Controller
{
    protected $category;
    protected $validator;

    public function __construct(CategoryRepositoryInterface $category, CategoryValidator $validator)
    {
        $this->category = $category;
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
        $result = $this->category->paginate($request->search);
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
        $category = $this->category->create($data);
        return response()->json([
            'status' => 200,
            'message' => 'Create successfully',
            'datas' => $category
        ]);
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
        $category = $this->category->find($id);
        return response()->json([
            'status' => 200,
            'message' => 'Successfully',
            'datas' => $category
        ]);
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
        $category = $this->category->find($id);
        if(!$category) {
            return response()->json([
                'status' => 403,
                'message' => 'Category not found',
            ]);
        }
        $data =  $request->all();
        try {
            $this->validator->with($data)->setId($id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 403,
                'message' => 'Bad request',
                'datas' => $e->getMessageBag()
            ]);
        }
        $category = $this->category->update($id, $data);
        return response()->json([
            'status' => 200,
            'message' => 'Update Successfully',
            'datas' => $category
        ]);
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
        return $this->category->delete($id);
    }
}
