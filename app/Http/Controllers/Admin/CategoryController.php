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
    public function viewList() {
        return view('admin.pages.category.index');
    }
    
    public function index(Request $request)
    {
        //
        $result = $this->category->paginate($request->search);
        $dataCategories = [];
        foreach($result as $key => $item) {
            $dataCategories[$key]['id'] = $item->id;
            $dataCategories[$key]['name'] = $item->name;
            $dataCategories[$key]['total_products'] = count($this->category->find($item->id)->Products()->get());
        }
        $datas = [
            'paginate' => $result,
            'categories' => $dataCategories,
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
        return view('admin.pages.category.create');
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
           return redirect()->route('admin.category.create')->withErrors($e->getMessageBag())->withInput();
        }
        $category = $this->category->create($data);
        $request->session()->flash('success', 'Create category successfully');

        return redirect()->route('admin.category.edit', $category->id);
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
        $category = $this->category->find($id);
        return view('admin.pages.category.edit', ['category' => $category]);
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
            return redirect()->back();
        }
        $data =  $request->all();
        try {
            $this->validator->with($data)->setId($id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            return redirect()->route('admin.category.edit', $id)->withErrors($e->getMessageBag())->withInput();
        }
        $category = $this->category->update($id, $data);
        $request->session()->flash('success', 'Update category successfully');
        return view('admin.pages.category.edit', ['category' => $category]);
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
