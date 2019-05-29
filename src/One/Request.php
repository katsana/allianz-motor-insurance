<?php

namespace Allianz\MotorInsurance\One;

use Allianz\MotorInsurance\Request as BaseRequest;
use Laravie\Codex\Contracts\Endpoint as EndpointContract;
use Laravie\Codex\Endpoint;

abstract class Request extends BaseRequest
{
    /**
     * Version namespace.
     *
     * @var string
     */
    protected $version = 'v1';

    /**
     * Get API Endpoint.
     *
     * @param string|array $path
     *
     * @return \Laravie\Codex\Contracts\Endpoint
     */
    protected function getApiEndpoint($path = []): EndpointContract
    {
        $host = $this->client->getApiEndpoint();

        return new Endpoint("{$host}/{$this->version}/openapi/mci", $path);
    }
}
