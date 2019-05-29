<?php

namespace Allianz\MotorInsurance\One;

use Laravie\Codex\Contracts\Response;

class Vehicle extends Request
{
    /**
     * Send quotation request.
     *
     * @param array $payload
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function submit(array $payload): Response
    {
        return $this->sendJson('POST', 'vehicleDetails', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }
}
