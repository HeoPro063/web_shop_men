<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Validators\PromotionValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Repositories\Promotion\PromotionRepositoryInterface; 
use DateTime;
class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $promotion;
    protected $validator;

    public function __construct(PromotionRepositoryInterface $promotion, PromotionValidator $validator)
    {
        $this->promotion = $promotion;
        $this->validator = $validator;
    }

    public function viewList() {
        return view('admin.pages.promotion.index');
    } 

    public function activeItem($id) {
        $promotion = $this->promotion->find($id);
        if($promotion->status) {
            $promotion->status = 0;
        } else {
            $promotion->status = 1;
        }
        $promotion->save();
        
        return response()->json([
            'status' => 200,
            'message' => 'Successfully',
            'datas' => $promotion
        ]);
    }

    public function index(Request $request)
    {
        //
        $result = $this->promotion->paginate($request->search);
        $dataPromotions = [];
        foreach($result as $key => $item) {
            $dataPromotions[$key]['id'] = $item->id;
            $dataPromotions[$key]['name'] = $item->name;
            $dataPromotions[$key]['percent'] = $item->percent;
            $dataPromotions[$key]['start_date'] = $item->start_date;
            $dataPromotions[$key]['end_date'] = $item->end_date;
            $dataPromotions[$key]['status'] = $item->status;
            $dataPromotions[$key]['total_products'] = count($this->promotion->find($item->id)->Products()->get());

            $earlier = new DateTime($item->start_date);
            $later = new DateTime($item->end_date);
            $abs_diff = $later->diff($earlier)->format("%a"); 
            $dataPromotions[$key]['total_days_promotion'] = $abs_diff + 1; 

            $now = time(); // or your date as well
            $your_date = strtotime($item->end_date);
            $datediff = $your_date - $now;
            $effective = round($datediff / (60 * 60 * 24)) + 1;
            $effective = $effective > 0 ? $effective : 0;
            $dataPromotions[$key]['effective'] = $effective; 
        }

        $datas = [
            'paginate' => $result,
            'promotions' => $dataPromotions,
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
        return view('admin.pages.promotion.create');
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
                'status' => 400,
                'message' => 'Error',
                'datas' => $e
            ]);
        }

        if(!$data['dataStartEnd']) {
            return response()->json([
                'status' => 400,
                'message' => 'Error',
            ]);
        }

        $data['start_date'] = $data['dataStartEnd'][0];
        $data['end_date'] = $data['dataStartEnd'][1];

        if($data['percent'] > 100 || $data['percent'] < 0) {
            return response()->json([
                'status' => 400,
                'message' => 'Error',
            ]);
        }
        unset($data['dataStartEnd']);
        $promotion = $this->promotion->create($data);
        return response()->json([
            'status' => 200,
            'message' => 'Successfully',
            'datas' => $promotion
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
        $promotion = $this->promotion->find($id);
        return view('admin.pages.promotion.edit', ['promotion' => $promotion]);
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
                'status' => 400,
                'message' => 'Error',
                'datas' => $e
            ]);
        }

        if(!$data['dataStartEnd']) {
            return response()->json([
                'status' => 400,
                'message' => 'Error',
            ]);
        }

        $data['start_date'] = $data['dataStartEnd'][0];
        $data['end_date'] = $data['dataStartEnd'][1];

        if($data['percent'] > 100 || $data['percent'] < 0) {
            return response()->json([
                'status' => 400,
                'message' => 'Error',
            ]);
        }
        unset($data['dataStartEnd']);
        $promotion = $this->promotion->update($id, $data);
        return response()->json([
            'status' => 200,
            'message' => 'Successfully',
            'datas' => $promotion
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
        return $this->promotion->delete($id);

    }
}
