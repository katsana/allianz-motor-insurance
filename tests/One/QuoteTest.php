<?php

namespace Allianz\MotorInsurance\Tests\One;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Laravie\Codex\Testing\Faker;
use Allianz\MotorInsurance\Client;
use Allianz\MotorInsurance\One\Quote;

class QuoteTest extends TestCase
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_can_submit_quotation()
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer AckfSECXIvnK5r28GVIWUAxmbBSjTsmF',
        ];

        $payload = [
            'coverage_type' => 'MT',
            'id_type' => '1',
            'id_value' => '820101015510',
            'vehicle_postcode' => '50000',
            'vehicle_reg_no' => 'ABC123',
            'drivers' => [
                ['email' => 'demo.etiqa@gmail.com'],
            ],
            'agent_code' => 'agent',
            'operator_code' => 'operator',
        ];

        $faker = Faker::create()
                    ->call('POST', $headers, json_encode($payload))
                    ->expectEndpointIs('/v1/openapi/mci/quote')
                    ->shouldResponseWith(200, '{"status":"OK","data":null}');

        $client = new Client($faker->http(), 'homestead', 'secret');
        $client->setAccessToken('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');

        $response = $client->uses('Quote')->submit($payload);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->toArray()['status']);
    }

    /** @test */
    public function it_can_throws_exception_when_status_is_errors()
    {
        $this->expectException('Laravie\Codex\Exceptions\HttpException');
        $this->expectExceptionMessage('Driver record incomplete. Please provide details');

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer AckfSECXIvnK5r28GVIWUAxmbBSjTsmF',
        ];

        $payload = [
            'coverage_type' => 'MT',
            'id_type' => '1',
            'id_value' => '820101015510',
            'vehicle_postcode' => '50000',
            'vehicle_reg_no' => 'ABC123',
            'drivers' => [
                ['email' => 'demo.etiqa@gmail.com'],
            ],
            'agent_code' => 'agent',
            'operator_code' => 'operator',
        ];

        $faker = Faker::create()
                    ->call('POST', $headers, json_encode($payload))
                    ->expectEndpointIs('/v1/openapi/mci/quote')
                    ->shouldResponseWith(500, '{"fault":"Driver record incomplete. Please provide details"}');

        $client = new Client($faker->http(), 'homestead', 'secret');
        $client->setAccessToken('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');

        $client->uses('Quote')->submit($payload);
    }

    /** @test */
    public function it_can_create_quick_quotation_draft()
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer AckfSECXIvnK5r28GVIWUAxmbBSjTsmF',
        ];

        $payload = [
            'coverage_type' => 'MT',
            'id_type' => '1',
            'id_value' => '820101015510',
            'vehicle_postcode' => '50000',
            'vehicle_reg_no' => 'ABC123',
            'drivers' => [
                ['email' => 'demo.etiqa@gmail.com'],
            ],
            'agent_code' => 'agent',
            'operator_code' => 'operator',
        ];

        $faker = Faker::create()
                    ->call('POST', $headers, json_encode($payload))
                    ->expectEndpointIs('/v1/openapi/mci/quote')
                    ->shouldResponseWith(200, '{"status":"OK","data":null}');

        $client = new Client($faker->http(), 'homestead', 'secret');
        $client->setAccessToken('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');

        $response = $client->uses('Quote')->draft($payload);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->toArray()['status']);
    }
}
