<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SmsGateway;

class SmsGatewayFormatter extends TestCase
{
    /** @test */
    public function it_can_format_phone_number_to_E_164()
    {
        $phoneNumber = '08155332242';

        $formattedNumber = app(SmsGateway::class)->formatPhoneNumber($phoneNumber);

        $this->assertEquals('+2348155332242', $formattedNumber);
    }
}
