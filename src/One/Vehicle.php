<?php

namespace Allianz\MotorInsurance\One;

use Laravie\Codex\Contracts\Response;

class Vehicle extends Request
{
    /**
     * Check vehicle coverage.
     *
     * @param int|string $yearManufactured
     * @param string $region Can either be 'W' (west) or 'E' (east)
     *
     * @return \Allianz\MotorInsurance\Response
     */
    public function variants(string $makeCode, string $modelCode, $yearManufactured, string $region = 'W'): Response
    {
        $payload = [
            'region' => $region,
            'makeCode' => $makeCode,
            'modelCode' => $modelCode,
            'makeYear' => $yearManufactured,
        ];

        return $this->sendJson('GET', 'lov/avVariant', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }

    /**
     * Check vehicle coverage.
     *
     * @param int|string $yearManufactured
     * @param string $region Can either be 'W' (west) or 'E' (east)
     *
     * @return \Allianz\MotorInsurance\Response
     */
    public function coverNoteVariants(string $makeCode, string $modelCode): Response
    {
        $payload = [
            'makeCode' => $makeCode,
            'modelCode' => $modelCode,
        ];

        return $this->sendJson('GET', 'lov/allianzVariant', $this->getApiHeaders(), $this->mergeApiBody($payload));
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
        $payload['sourceSystem'] = $this->client->getPartnerId();

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
        $payload['SourceSystem'] = $this->client->getPartnerId();

        return $this->sendJson('POST', 'checkUBB', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }
}
