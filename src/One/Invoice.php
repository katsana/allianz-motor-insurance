<?php

namespace Allianz\MotorInsurance\One;

use Laravie\Codex\Contracts\Response;

class Invoice extends Request
{
    /**
     * Create quick invoice request.
     *
     * @param array $payload
     *
     * @return \Allianz\MotorInsurance\Response
     */
    public function submit(array $payload): Response
    {
        return $this->sendJson('POST', 'submission', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }
}
