<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Validators\ColorValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Repositories\Color\ColorRepositoryInterface; 

class ColorController extends Controller
{
    //

    protected $color;
    protected $validator;

    public function __construct(ColorRepositoryInterface $color, ColorValidator $validator)
    {
        $this->color = $color;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewList() {
        return view('admin.pages.color.index');
    }

    public function index(Request $request)
    {
        //
        $result = $this->color->paginate($request->search);
        $dataColor = [];

        foreach($result as $key => $item) {
            $dataColor[$key]['id'] = $item->id;
            $dataColor[$key]['name'] = $item->name;
            $dataColor[$key]['favcolor'] = $item->favcolor;
        }
        $datas = [
            'paginate' => $result,
            'colors' => $dataColor,
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
        return view('admin.pages.color.create');
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
           return redirect()->route('admin.color.create')->withErrors($e->getMessageBag())->withInput();
        }
        $color = $this->color->create($data);
        $request->session()->flash('success', 'Create color successfully');

        return redirect()->route('admin.color.edit', $color->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $color = $this->color->find($id);
        return view('admin.pages.color.edit', ['color' => $color]);
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
        $color = $this->color->find($id);
        if(!$color) {
            return redirect()->back();
        }
        $data =  $request->all();
        try {
            $this->validator->with($data)->setId($id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            return redirect()->route('admin.color.edit', $id)->withErrors($e->getMessageBag())->withInput();
        }
        $color = $this->color->update($id, $data);
        $request->session()->flash('success', 'Update color successfully');
        return view('admin.pages.color.edit', ['color' => $color]);
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
        return $this->color->delete($id);
    }
}
