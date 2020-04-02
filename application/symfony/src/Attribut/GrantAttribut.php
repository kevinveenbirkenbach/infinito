<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 *
 * @see GrantAttributInterface
 */
trait GrantAttribut
{
    /**
     * @var bool
     */
    protected $grant;

    public function setGrant(bool $grant): void
    {
        $this->grant = $grant;
    }

    public function getGrant(): bool
    {
        return $this->grant;
    }
}
