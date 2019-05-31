<?php

namespace Allianz\MotorInsurance\Passport;

use Laravie\Codex\Contracts\Response;

class Credential extends Request
{
    /**
     * Create access token.
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function createAccessToken(): Response
    {
        return $this->send('POST', 'oauth/accesstoken', $this->getApiHeaders(), $this->getApiBody());
    }

    /**
     * Get API Body.
     *
     * @return array
     */
    protected function getApiHeaders(): array
    {
        return [
            'Authorization' => $this->getAuthorizationBearer(),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
    }

    /**
     * Get API Body.
     *
     * @return array
     */
    protected function getApiBody(): array
    {
        return [
            'grant_type' => 'client_credentials',
        ];
    }

    /**
     * Get authorization bearer.
     *
     * @return string
     */
    protected function getAuthorizationBearer(): string
    {
        return \implode(' ', [
            'Basic',
            \base64_encode($this->client->getClientId().':'.$this->client->getClientSecret())
        ]);
    }
}
