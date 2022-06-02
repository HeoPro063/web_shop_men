<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Validators\RoleValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Repositories\Role\RoleRepositoryInterface; 

class RoleController extends Controller
{

    protected $role;
    protected $validator;

    public function __construct(RoleRepositoryInterface $role, RoleValidator $validator)
    {
        $this->role = $role;
        $this->validator = $validator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewList() {
        return view('admin.pages.role.index');
    }
    public function index(Request $request)
    {
        $result = $this->role->paginate($request->search);
        $dataRoles = [];
        foreach($result as $key => $item) {
            $dataRoles[$key]['id'] = $item->id;
            $dataRoles[$key]['name'] = $item->name;
            $dataRoles[$key]['total_user'] = count($this->role->find($item->id)->Users()->get());
        }
        $datas = [
            'paginate' => $result,
            'roles' => $dataRoles,
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
        return view('admin.pages.role.create');
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
           return redirect()->route('admin.role.create')->withErrors($e->getMessageBag())->withInput();
        }
        $role = $this->role->create($data);
        $request->session()->flash('success', 'Create role successfully');

        return redirect()->route('admin.role.edit', $role->id);
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
        $role = $this->role->find($id);
        return view('admin.pages.role.edit', ['role' => $role]);
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

        $role = $this->role->find($id);
        if(!$role) {
            return redirect()->back();
        }
        $data =  $request->all();
        try {
            $this->validator->with($data)->setId($id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            return redirect()->route('admin.role.edit', $id)->withErrors($e->getMessageBag())->withInput();
        }
        $role = $this->role->update($id, $data);
        $request->session()->flash('success', 'Create role successfully');
        return view('admin.pages.role.edit', ['role' => $role]);
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
        return $this->role->delete($id);
    }
}
