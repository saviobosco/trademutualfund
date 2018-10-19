<?php

namespace Tests\Unit;

use App\PhoneVerification;
use Tests\TestCase;

class PhoneVerificationTest extends TestCase
{
    public $PhoneVerification;

    public function setUp()
    {
        $this->PhoneVerification = new PhoneVerification();
    }

    /** @test */
    public function testVerifyPhoneNumber()
    {
        $this->PhoneVerification->verifyPhoneNumber('08068865957');
        $this->assertEquals('2348068865957', $this->PhoneVerification->getPhoneNumber());

        $this->PhoneVerification->verifyPhoneNumber('2348068865957');
        $this->assertEquals('2348068865957', $this->PhoneVerification->getPhoneNumber());
    }
}
