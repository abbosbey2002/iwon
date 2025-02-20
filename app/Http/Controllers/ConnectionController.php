<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneRequest;
use App\Http\Requests\Site\LoginRequest;
use App\Models\Language;
use App\Services\Query\IwonQuery;
use App\Services\Query\SoloQuery;
use Illuminate\Http\Request;
use App\Services\Query\AuthQuery;

class ConnectionController extends Controller
{
    public IwonQuery $iwonapi;
    public AuthQuery $authquery;
    public SoloQuery $soloapi;

    public function __construct(IwonQuery $iwonapi, SoloQuery $soloapi, AuthQuery $authquery)
    {
        $this->iwonapi = $iwonapi;
        $this->authquery = $authquery;
        $this->soloapi = $soloapi;
    }

    public function index()
    {
        $language = Language::all();

        return view('auth.welcome', compact('language'));
    }

    public function getVoucher()
    {
        return view('auth.get_voucher');
    }

    public function checkVacherPage(PhoneRequest $request)
    {
        $phone = $request->getphone();
        
        $iscleint = $this->iwonapi->isClient($phone);

        if (!$iscleint) {
            return redirect()->back()->with('phone_error', 'This phone number is not a client of IWON');
        }
        
        $voucher = $this->soloapi->storeVoucher($phone);

        if ($voucher['status'] == 200) {
            $body = $voucher['body'];
            $voucher_id = $voucher['body']['voucher_id'];
            $phone = $body['phone'];
            $this->iwonapi->sendVoucherClient( $phone, $voucher_id );
            return view('auth.check_vacher', compact('phone'));
        }

    }

public function connect(LoginRequest $request)
    {
        $username =(string) $request->getPhone();
        $password = (string) $request->getVoucherID();

        $response = $this->authquery->login($request);
        
        dd($response);
        if ($response['status'] == 200) {   
            $message = $this->errors->message($response['body']['items']['v_status']);

            return redirect()->route('ads.view');
        }

    }

    public function setLocale(Request $request)
    {
        $allowedLocales = Language::pluck('code')->toArray();
        $locale = $request->language;
        if (in_array($locale, $allowedLocales)) {
            session(['locale' => $locale]);

            return redirect()->back();
        }

        return response()->json(['message' => 'Invalid locale!']);
    }
}
