<?php

namespace Allianz\MotorInsurance\Tests\One;

use Allianz\MotorInsurance\Client;
use Laravie\Codex\Testing\Faker;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class VehicleTest extends TestCase
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_can_submit_vehicle()
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer AckfSECXIvnK5r28GVIWUAxmbBSjTsmF',
        ];

        $payload = [
            'vehicle_postcode' => '50000',
            'vehicle_reg_no' => 'ABC123',
            'sourceSystem' => 'partner',
        ];

        $faker = Faker::create()
                    ->call('POST', $headers, json_encode($payload))
                    ->expectEndpointIs('/v1/openapi/mci/vehicleDetails')
                    ->shouldResponseWith(200, '{"status":"OK","data":null}');

        $client = new Client($faker->http(), 'homestead', 'secret', 'partner');
        $client->setAccessToken('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');

        $response = $client->uses('Vehicle')->information($payload);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->toArray()['status']);
    }
}
