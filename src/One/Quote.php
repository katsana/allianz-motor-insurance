<?php

namespace Allianz\MotorInsurance\One;

use Laravie\Codex\Contracts\Response;

class Quote extends Request
{
    /**
     * Create quick draft quotation request.
     *
     * @param array $payload
     *
     * @return \Allianz\MotorInsurance\Response
     */
    public function draft(array $payload): Response
    {
        return $this->sendJson('POST', 'quote', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }

    /**
     * Send quotation request.
     *
     * @param array $payload
     *
     * @return \Allianz\MotorInsurance\Response
     */
    public function update(array $payload): Response
    {
        return $this->sendJson('PUT', 'quote', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }
}
