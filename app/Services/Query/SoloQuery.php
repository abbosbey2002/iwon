<?php

namespace App\Services\Query;

use App\Helpers\CookieHelper;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\PhoneRequest;
use App\Http\Requests\Search\SearchRequest;
use App\Http\Requests\Voucher\VoucherRequest;
use App\Models\Settings;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;

class SoloQuery
{
    protected Client $httpClient;

    protected CookieHelper $cookieHelper;

    protected string $apiUrl;

    protected string $authToken;

    public function __construct(CookieHelper $cookieHelper)
    {
        $this->cookieHelper = $cookieHelper;
        $this->httpClient = new Client;
        $this->apiUrl = config('solo.url');
        $this->authToken = 'Basic '.base64_encode(config('solo.username').':'.config('solo.password'));
    }

    private function generateAuthToken($requestJSON)
    {
        $userName = config('solo.username');
        $secretKey = config('solo.secret_key');
        $json = json_encode($requestJSON);

        $auth = "{$userName} {$secretKey} {$json}";

        return md5($auth);
    }

    public function checkVoucher(string $phone): bool
    {
        $this->fetchVouchers($phone);

        return false;
    }

    /**
     * Sends a request to Solo API.
     *
     * @param  array  $payload  Data to be sent.
     * @param  string  $method  HTTP method to use.
     * @param  string  $endpoint  Endpoint to send the request to.
     * @return array Response from the Solo API.
     */
    private function sendRequest(array $payload, string $method, string $endpoint): array
    {
        try {
            $response = $this->httpClient->request($method, $this->apiUrl.$endpoint, [
                'json' => $payload,
                'http_errors' => false,
                'headers' => [
                    'Authorization' => $this->authToken,
                    'X-Access-Token' => $this->generateAuthToken($payload),
                ],
            ]);
            return [
                'status' => $response->getStatusCode(),
                'body' => json_decode($response->getBody(), true),
            ];
        } catch (\Exception $exception) {
            Log::error('API Request Error: '.$exception->getMessage());

            return ['status' => false, 'message' => 'No response from server'];
        }
    }

   
    public function searchVouchers(SearchRequest $request): array
    {
        $endpoint = '/hotel/voucher/search';
        $payload = [
            'username' => $this->cookieHelper->getUsername(),
            'password' => $this->cookieHelper->getPassword(),
            'query' => $request->getQuery(),
            'page' => $request->getPage(),
            'limit' => $request->getLimit(),
            'timestamp' => time(),
        ];

        return $this->sendRequest($payload, 'POST', $endpoint);
    }

    private function customerExists(string $phone): ?Customer
    {
        return Customer::where('phone', $phone)->first();
    }

    public function storeVoucher(string $phone)
    {
        $checkcustomer = $this->customerExists($phone);
        if($checkcustomer){
            return ['status' => 200, 'body' => $checkcustomer->toArray()];
        }
        
        $days = Settings::first()->expired_date ? Settings::first()->expired_date : 30;
        
        $endpoint = '/hotel/voucher/new';   
        $payload = [
            'username' => 'TTP190000365',
            'password' => '5555',
            'phone' => $phone,
            'visitor' => 'testing visitor',
            'room' => 12,
            'date_begin' => now()->format('Y-m-d'),
            'date_end' => now()->addDays($days)->format('Y-m-d'),
            'days' => $days,
            'lang' => 'en',
            'unixtime' => time(),
        ];
        
        $response = $this->sendRequest($payload, 'POST', $endpoint);
        if ($response['status'] === 200) {
            $response['body'] = array_merge($response['body'], $payload);
            $customer = $this->savecustomer($response['body']);
            return $response;
        }else{
            return $response;
        }

    }

    private function savecustomer($voucher):bool
    {
        $customer = new Customer();
        $customer->username = $voucher['username'];
        $customer->password = $voucher['password'];
        $customer->phone = $voucher['phone'];
        $customer->voucher_id = $voucher['voucher_id'];
        $customer->days = $voucher['days'];
        $customer->lang = $voucher['lang'];
        $customer->date_begin = $voucher['date_begin'];
        $customer->date_end = $voucher['date_end'];
    
        return $customer->save();
    }

}
