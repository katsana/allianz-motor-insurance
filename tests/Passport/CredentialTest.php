<?php

namespace Allianz\MotorInsurance\Tests\Passport;

use Allianz\MotorInsurance\Client;
use Allianz\MotorInsurance\Passport\Credential;
use Laravie\Codex\Testing\Faker;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class CredentialTest extends TestCase
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_can_authenticate_user()
    {
        $headers = [
            'Authorization' => 'Basic aG9tZXN0ZWFkOnNlY3JldA==',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $payload = [
            'grant_type' => 'client_credentials',
        ];

        $faker = Faker::create()
                    ->call('POST', $headers, http_build_query($payload))
                    ->expectEndpointIs('https://api.allianz.com.my/passport/v1/oauth/accesstoken')
                    ->shouldResponseWith(200, '{"status":"OK","data":{"access_token":"AckfSECXIvnK5r28GVIWUAxmbBSjTsmF"}}');

        $client = new Client($faker->http(), 'homestead', 'secret');
        $client->useCustomPassportEndpoint('https://api.allianz.com.my/passport');
        $client->setAccessToken(null);

        $response = $client->via(new Credential($client))->createAccessToken();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->toArray()['status']);
        $this->assertSame(['access_token' => 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF'], $response->toArray()['data']);
    }
}
