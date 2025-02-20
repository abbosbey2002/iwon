<?php

namespace App\Services;

use App\Helpers\CookieHelper;
use App\Http\Requests\Site\Auth\LoginRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $client;

    protected $cookie;

    protected $url;

    protected $token;

    protected $pbhkIdent;

    protected $isPhone;

    public function __construct(CookieHelper $cookieHelper)
    {
        $port = (int) ($_SERVER['REMOTE_PORT'] / 16);
        $this->pbhkIdent = "S{$_SERVER['REMOTE_ADDR']}:{$port}";
        $this->cookie = $cookieHelper;
        $this->client = new Client;
        $this->isPhone = 0;
        $this->url = config('solo.url');
    }

    public function login(LoginRequest $request, string $method = 'POST')
    {
        try {
            $data = $this->client->request($method, env('SOLA_AUTH_API').'/uid/voucher/'.$this->pbhkIdent, [
                'json' => [
                    'phn' => $request->getPhone(),
                    'voucher_id' => $request->getVoucherID(),
                    'lang' => App::getLocale(),
                    'apple' => $this->isPhone,
                ],
                'http_errors' => false,
            ]);
        } catch (\Exception $exception) {
            return abort(403);
        }

        $return = [
            'status' => $data->getStatusCode(),
            'body' => json_decode($data->getBody(), true),
        ];

        return $return;
    }

    public function attemptLogin($credentials)
    {
        return Auth::attempt($credentials);
    }
}
