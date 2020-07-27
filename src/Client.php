<?php

namespace Allianz\MotorInsurance;

use Http\Client\Common\HttpMethodsClient as HttpClient;
use Laravie\Codex\Client as BaseClient;

class Client extends BaseClient
{
    /**
     * API Key.
     *
     * @var string
     */
    protected $clientId;

    /**
     * API Secret.
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * Partner ID.
     *
     * @var string
     */
    protected $partnerId;

    /**
     * API Access Token.
     *
     * @var string|null
     */
    protected $accessToken;

    /**
     * The Passport (OAuth2) endpoint.
     *
     * @var string
     */
    protected $passportEndpoint;

    /**
     * List of supported API versions.
     *
     * @var array
     */
    protected $supportedVersions = [
        'v1' => 'One',
    ];

    /**
     * Construct a new Client.
     *
     * @param \Http\Client\Common\HttpMethodsClient $http
     * @param string                                $clientId
     * @param string                                $clientSecret
     * @param string                                $partnerId
     */
    public function __construct(HttpClient $http, string $clientId, string $clientSecret, string $partnerId)
    {
        $this->http = $http;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Get API Key.
     *
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * Get API Secret.
     *
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * Get Partner ID.
     *
     * @return string
     */
    public function getPartnerId(): string
    {
        return $this->partnerId;
    }

    /**
     * Get passport endpoint.
     *
     * @return string|null
     */
    public function getPassportEndpoint(): ?string
    {
        return $this->passportEndpoint;
    }

    /**
     * Get access token.
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * Set Partner ID.
     *
     * @param string $partnerId
     *
     * @return $this
     */
    public function setPartnerId(string $partnerId)
    {
        $this->partnerId = $partnerId;

        return $this;
    }

    /**
     * Set access token.
     *
     * @param string|null $accessToken
     *
     * @return $this
     */
    public function setAccessToken(?string $accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get resource default namespace.
     *
     * @return string
     */
    protected function getResourceNamespace(): string
    {
        return __NAMESPACE__;
    }

    /**
     * Use custom Passport Endpoint.
     *
     * @param string $endpoint
     *
     * @return $this
     */
    public function useCustomPassportEndpoint(string $endpoint)
    {
        $this->passportEndpoint = $endpoint;

        return $this;
    }
}
