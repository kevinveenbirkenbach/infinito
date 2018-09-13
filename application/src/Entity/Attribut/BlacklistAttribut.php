<?php

namespace App\Entity\Attribut;

/**
 * @author kevinfrantz
 */
trait BlacklistAttribut
{
    /**
     * @var bool
     */
    protected $blacklist;

    public function setBlacklist(?bool $value): void
    {
        $this->blacklist = $value;
    }

    public function getBlacklist(): ?bool
    {
        return $this->blacklist;
    }
}
