<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/19/18
 * Time: 10:51 AM
 */

namespace App;


use Illuminate\Support\Facades\Cache;

class PhoneVerification
{
    protected $phone_number = null;
    protected $verification_code = null;

    public function verifyPhoneNumber($phone_number) {
        // format the phone number
        $phone_number_count = strlen($phone_number);
        if ($phone_number_count <= 11) {
            $this->phone_number = substr_replace($phone_number, '234', 0, 1);
        } else {
            $this->phone_number = substr_replace($phone_number, '234', 0, 3);
        }
        return $this;
    }

    public function sendVerificationCode()
    {
        if (Cache::has($this->phone_number)) {
            return true;
        }
        $verification_pin = $this->generateVerificationPin();
        $SMSGateWay = new SMSGateWay(env('SMS_HOST'), env('SMS_USERNAME'), env('SMS_PASSWORD'));
        $response = $SMSGateWay
            ->sendMessage($this->phone_number, env('APP_NAME').": Your verification code is $verification_pin . Expires in 10 minutes")
            ->sendRequestToSMSServer();
        if ((int)$response->read(1024) === 100) {
            Cache::put($this->phone_number, $verification_pin, now()->addMinutes(10));
            return true;
        }
    }

    public function generateVerificationPin()
    {
        return rand(1111, 9999);
    }

    public function verifyCode($verification_code)
    {
        if (! Cache::has($this->phone_number)) {
            return false;
        }
        return  Cache::get($this->phone_number) === (int) $verification_code;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }
}