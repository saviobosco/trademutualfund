<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/19/18
 * Time: 10:51 AM
 */

namespace App;


use GuzzleHttp\Client;

class SMSGateWay
{
    protected $host;
    protected $url = null;
    protected $username = null;
    protected $password = null;
    protected $request = null;
    public $response = null;

    public function __construct($host, $user_name, $password)
    {
        $this->host = $host;
        $this->username = $user_name;
        $this->password = $password;
    }

    public function sendMessage($phone_number, $message)
    {
        $queryParameters = http_build_query([
            'username' => $this->username,
            'password' => $this->password,
            'sender' => setting('app_name'),
            'message' => $message,
            'recipients' => $phone_number,
            'forcednd' => 1
        ]);
        $this->request = "$this->host/tools/geturl/Sms.php?$queryParameters";
        return $this;
    }

    /**
     * @return bool|\Psr\Http\Message\StreamInterface
     */
    public function sendRequestToSMSServer()
    {
        $client = new Client();
        try {
            $this->response = $client->request('GET', $this->request, [
                'headers' => [
                    'User-Agent' => 'HTTPie/0.9.8',
                    'Accepts'     => '*/*',
                ]
            ]);
            return $this->response->getBody();
        } catch ( \Exception $exception) {
            return false;
        }
    }

    public function checkBalance()
    {
        $queryParameters = http_build_query([
            'username' => $this->username,
            'password' => $this->password,
        ]);
        $this->request = "$this->host/tools/command.php?$queryParameters";
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}