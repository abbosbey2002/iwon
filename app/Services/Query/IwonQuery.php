<?php

namespace App\Services\Query;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IwonQuery
{
    public string $username;
    public string $password;
    public string $apiUrl;

    public function __construct(){
        $this->apiUrl = config('iwon.url');
        $this->username = config('iwon.client-id');
        $this->password = config('iwon.client-secret');
    }
    /**
     * Checks if the given phone number is a client of IWON.
     */
    public  function isClient(string $phone): bool
    {
        
        try {
            $response = Http::withBasicAuth($this->username, $this->password)
                ->post($this->apiUrl.'v1/wallet3/sola/voucher/check-number', [
                    'phone' => $phone,
                ]);

            if ($response->successful() && $response->json()['status'] === 'success') {
                return (bool) $response->json()['success'];
            }
        } catch (\Exception $exception) {
            Log::error('IWON API Request Error: '.$exception->getMessage());
        }

        return false;
    }

    public function sendVoucherClient($phone, $voucher){
        $response = Http::withBasicAuth($this->username, $this->password)
                ->post($this->apiUrl.'v1/wallet3/sola/voucher/send', [
                    'phone' => $phone,
                    'voucher' => $voucher,
                ]);
    }
}
