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

    public function viewList() {
        return view('admin.pages.size.index');
    }

    public function index(Request $request)
    {
        $result = $this->size->paginate($request->search);
        $dataSizes = [];

        foreach($result as $key => $item) {
            $dataSizes[$key]['id'] = $item->id;
            $dataSizes[$key]['name'] = $item->name;
            $dataSizes[$key]['total_products'] = count($this->size->find($item->id)->Products()->get());
        }
        $datas = [
            'paginate' => $result,
            'sizes' => $dataSizes,
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
        return view('admin.pages.size.create');
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
           return redirect()->route('admin.size.create')->withErrors($e->getMessageBag())->withInput();
        }
        $size = $this->size->create($data);
        $request->session()->flash('success', 'Create size successfully');

        return redirect()->route('admin.size.edit', $size->id);
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
        $size = $this->size->find($id);
        return view('admin.pages.size.edit', ['size' => $size]);
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
            return redirect()->back();
        }
        $data =  $request->all();
        try {
            $this->validator->with($data)->setId($id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            return redirect()->route('admin.size.edit', $id)->withErrors($e->getMessageBag())->withInput();
        }
        $size = $this->size->update($id, $data);
        $request->session()->flash('success', 'Create size successfully');
        return view('admin.pages.size.edit', ['size' => $size]);
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
