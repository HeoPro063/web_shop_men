<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Validators\SizeValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Repositories\Size\SizeRepositoryInterface; 

class SizeController extends Controller
{

    protected $size;
    protected $validator;

    public function __construct(SizeRepositoryInterface $size, SizeValidator $validator)
    {
        $this->size = $size;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = $this->size->paginate($request->search);
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
        $size = $this->size->create($data);
        return response()->json([
            'status' => 200,
            'message' => 'create successfully',
            'datas' => $size
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
        $size = $this->size->find($id);
        return response()->json([
            'status' => 200,
            'message' => 'successfully',
            'datas' => $size
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
        $size = $this->size->find($id);
        if(!$size) {
            return response()->json([
                'status' => 403,
                'message' => 'Size not found',
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
        $size = $this->size->update($id, $data);
        return response()->json([
            'status' => 200,
            'message' => 'update successfully',
            'datas' => $size
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
        return $this->size->delete($id);
    }
}
