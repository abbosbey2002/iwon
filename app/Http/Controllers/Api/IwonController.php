<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\CreateiwonVoucherRequest;
use App\Services\Query\SoloQuery; // SoloQuery

class IwonController extends Controller
{
    public SoloQuery $soloapi;
    public function __construct(SoloQuery $soloapi)
    {
        $this->soloapi = $soloapi;
    }


    public function store(CreateiwonVoucherRequest $request){
        $response = $this->soloapi->storeVoucher($request->phone);
        return response()->json($response);
    }
}
