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
     * @return \Laravie\Codex\Contracts\Response
     */
    public function draft(array $payload): Response
    {
        return $this->submit($payload);
    }

    /**
     * Send quotation request.
     *
     * @param array $payload
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function submit(array $payload): Response
    {
        return $this->sendJson('POST', 'quote', $this->getApiHeaders(), $this->mergeApiBody($payload));
    }
}
