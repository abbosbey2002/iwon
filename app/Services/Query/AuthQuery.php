<?php

namespace App\Services\Query;

use App\Helpers\setCookie;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Http\Requests\Site\LoginRequest;

class AuthQuery
{
    protected $pbhkIdent;
    protected $client;
    protected $lang;
    protected $isPhone;

    public function __construct()
    {
        $port = isset($_SERVER['REMOTE_PORT']) ? (int) ($_SERVER['REMOTE_PORT'] / 16) : 0;
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $this->pbhkIdent = "S{$ipAddress}:{$port}";
        $this->isPhone = 0; // Agar foydalanuvchi agentidan tekshirish bo'lsa, uni qo'shish mumkin.
        $this->client = new Client();
    }

    /**
     * Foydalanuvchini API orqali autentifikatsiya qilish.
     *
     * @param LoginRequest $request
     * @return array
     */
    public function login(LoginRequest $request): array
    {
        $method = 'POST';

        $apiUrl = config('solo.solo_auth_api') . '/uid/voucher/' . $this->pbhkIdent;
        try {
            $response = $this->client->request($method, $apiUrl, [
                'json' => [
                    'phn' => $request->getPhone(),
                    'voucher_id' => $request->getVoucherID(),
                    'lang' => App::getLocale(),
                    'apple' => $this->isPhone
                ],
                'http_errors' => false
            ]);

            // API dan noto‘g‘ri yoki bo‘sh javob kelsa
            if (!$response) {
                Log::error('API javobi bo‘sh qaytdi.');
                return [
                    'status' => 500,
                    'body' => ['error' => 'Serverda xatolik yuz berdi.']
                ];
            }

            return [
                'status' => $response->getStatusCode(),
                'body' => json_decode($response->getBody(), true)
            ];

        } catch (\Exception $exception) {
            Log::error('Login API xatosi: ' . $exception->getMessage());
            return [
                'status' => 500,
                'body' => ['error' => 'Server xatosi. = ' . $exception->getMessage()]
            ];
        }
    }
}
