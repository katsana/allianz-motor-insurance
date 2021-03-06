<?php

namespace Allianz\MotorInsurance\Tests;

use Allianz\MotorInsurance\Client;
use Laravie\Codex\Testing\Faker;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_has_proper_signature()
    {
        $faker = Faker::create();

        $client = new Client($faker->http(), 'id', 'secret', 'partner');

        $this->assertSame('id', $client->getClientId());
        $this->assertSame('secret', $client->getClientSecret());

        $this->assertNull($client->getAccessToken());
    }

    /** @test */
    public function it_can_use_custom_passport_endpoint()
    {
        $faker = Faker::create();

        $client = new Client($faker->http(), 'id', 'secret', 'partner');

        $client->useCustomPassportEndpoint('https://api.etiqa.com.my/passport');

        $this->assertSame('https://api.etiqa.com.my/passport', $client->getPassportEndpoint());
    }

    /** @test */
    public function it_can_set_access_token()
    {
        $faker = Faker::create();

        $client = new Client($faker->http(), 'id', 'secret', 'partner');

        $this->assertNull($client->getAccessToken());

        $client->setAccessToken('abc');

        $this->assertSame('abc', $client->getAccessToken());
    }
}
