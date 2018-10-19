<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/19/18
 * Time: 10:41 AM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\PhoneVerification;
use Illuminate\Http\Request;

class VerifyPhoneController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function displayNotice()
    {
        return view('auth.verify_phone');
    }

    public function sendCode(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required'
        ]);
        auth()->user()->update($request->only(['phone_number']));
        if ($this->sendVerificationCode($request->input('phone_number')) === true) {
            return response()->json([
                'data' => 'OK'
            ]);
        }
        return response()->json([
            'data' => 'Error'
        ]);
    }

    public function resendCode(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required'
        ]);
        if ($this->sendVerificationCode($request->input('phone_number')) === true) {
            return response()->json([
                'data' => 'OK'
            ]);
        }
    }

    public function verifyCode(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
            'code' => 'required'
        ]);
        if ((new PhoneVerification())->verifyPhoneNumber($request->input('phone_number'))->verifyCode($request->input('code'))) {
            auth()->user()->markPhoneAsVerified();
            return response()->json([
                'data' => 'OK'
            ]);
        }
        return response()->json([
            'data' => 'Error',
            'message' => 'Invalid code'
        ]);
    }

    protected function sendVerificationCode($phone_number)
    {
        return (new PhoneVerification())->verifyPhoneNumber($phone_number)->sendVerificationCode();
    }
}