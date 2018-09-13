<?php

namespace App\Entity\Attribut;

/**
 * @author kevinfrantz
 */
trait WhitelistAttribut
{
    /**
     * @var bool
     */
    protected $whitelist;

    public function setWhitelist(?bool $value): void
    {
        $this->whitelist = $value;
    }

    public function getWhitelist(): ?bool
    {
        return $this->whitelist;
    }
}
