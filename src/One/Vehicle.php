<?php

namespace Allianz\MotorInsurance\One;

use Laravie\Codex\Contracts\Response;

class Vehicle extends Request
{
    /**
     * Check vehicle coverage.
     *
     * @param  int|string $yearManufactured
     *
     * @return \Allianz\MotorInsurance\Response
     */
    public function coverage(string $makeCode, string $modelCode, $yearManufactured): Response
    {
        return $this->sendJson('GET', 'lov/avVariant', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }

    /**
     * Send vehicle information request.
     *
     * @param array $payload
     *
     * @return \Allianz\MotorInsurance\Response
     */
    public function information(array $payload): Response
    {
        return $this->sendJson('POST', 'vehicleDetails', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }

    /**
     * Send vehicle verification request.
     *
     * @param array $payload
     *
     * @return \Allianz\MotorInsurance\Response
     */
    public function verification(array $payload): Response
    {
        return $this->sendJson('POST', 'checkUBB', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }
}
