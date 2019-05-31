<?php

namespace Allianz\MotorInsurance;

use Laravie\Codex\Exceptions\HttpException;
use Laravie\Codex\Response as BaseResponse;
use Allianz\MotorInsurance\Exceptions\RequestHasFailedException;

class Response extends BaseResponse
{
    /**
     * Validate the response object.
     *
     * @return $this
     */
    public function validate()
    {
        $payload = $this->toArray();
        $statusCode = $this->getStatusCode();

        if ($statusCode === 401) {
            throw new Exceptions\NotAuthorizedException($this, $this->getReasonPhrase());
        } elseif ($statusCode === 500) {
            throw new HttpException($this, $this->toArray()['fault']);
        } elseif ($statusCode !== 200) {
            throw new HttpException($this, $this->getReasonPhrase());
        }

        return $this;
    }
}
