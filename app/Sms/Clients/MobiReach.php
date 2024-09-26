<?php

namespace App\Sms\Clients;

use App\Sms\ClientBase;
use App\Sms\Clients\MobiReach\Result;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class MobiReach extends ClientBase
{
    private $from;
    private $userName;
    private $password;
    private $apiBase;

    function __construct($config)
    {
        $this->userName = $this->assertConfig($config, 'user_name');
        $this->password = $this->assertConfig($config, 'password');
        $this->from     = $this->assertConfig($config, 'from');
        $this->apiBase  = $this->assertConfig($config, 'api_base');

        info('mobireach ', [$config]);
    }

    private function assertConfig($config, $key)
    {
        $value = Arr::get($config, $key);

        if (empty($value)) {
            throw new \Exception("{$key} configuration cannot be empty");
        }
        return $value;
    }

    private function callApi($endPoint, $data = [])
    {
        $url      = "https://api.mobireach.com.bd/SendTextMessage?Username=ortl&Password=Octaglory@2022&From=8801866453399&To={$data['To']}&Message={$data['Message']}";
        $response = Http::get($url);
        \Log::debug("MobiReach::{$endPoint} response",
            ["status" => $response->status(), "body" => (string) $response->body()]);
        $results = $this->parseResponse($response);
        $this->logApiResult($endPoint, $results, $data);
        return is_array($results) && count($results) === 1 ? $results[0] : $results;
    }

    private function logApiResult($endPoint, $results, $data)
    {
        $request = Arr::except($data, ['Username', 'Password']);
        $results = is_array($results) ? $results : [$results];
        foreach ($results as $result) {
            if ($result->isError()) {
                \Log::error("MobiReach::{$endPoint} result", compact('request', 'result'));
            } else {
                \Log::debug("MobiReach::{$endPoint} result", compact('request', 'result'));
            }
        }
    }

    private function parseResponse($response)
    {
        $xml = simplexml_load_string((string) $response->getBody());
        if ($xml->getName() === 'ArrayOfServiceClass') {
            $results = [];
            foreach ($xml->children() as $child) {
                $results[] = new Result($child);
            }
            return $results;
        } else {
            if ($xml->getName() === 'ServiceClass') {
                return new Result($xml);
            }
        }
        throw new \Exception('Unknown response received');
    }

    public function send($toNumber, $message)
    {
        return $this->callApi('SendTextMessage', [
            'To'      => $toNumber,
            'Message' => $message,
        ]);
    }

    public function sendMultiple($toNumbers, $message)
    {
        $toNumbers   = array_filter($toNumbers);
        $numberCount = count($toNumbers);
        if ($numberCount === 0) {
            throw new \Exception("toNumbers param cannot be empty");
        }

        $chunks = array_chunk($toNumbers, 200, false);

        $results = [];
        foreach ($chunks as $chunk) {
            $results[] = $this->callApi('SendTextMultiMessage', [
                'To'      => implode(',', $chunk),
                'Message' => $message,
            ]);
        }

        return Arr::flatten($results);
    }

    public function getStatus($sendApiResponse)
    {
        return $this->callApi('GetMessageStatus', [
            'MessageId' => $sendApiResponse->MessageID,
        ]);
    }
}
