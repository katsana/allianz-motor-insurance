<?php

namespace Allianz\MotorInsurance\One;

use Laravie\Codex\Contracts\Response;

class Postcode extends Request
{
    /**
     * Check vehicle coverage.
     *
     * @return \Allianz\MotorInsurance\Response
     */
    public function search(string $postCode): Response
    {
        return $this->sendJson('GET', 'postalCodes', $this->getApiHeaders(), $this->mergeApiBody(['postCode' => $postCode]));
    }
}
