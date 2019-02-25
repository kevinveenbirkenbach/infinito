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

    /**
     * @param bool $grant
     */
    public function setGrant(bool $grant): void
    {
        $this->grant = $grant;
    }

    /**
     * @return bool
     */
    public function getGrant(): bool
    {
        return $this->grant;
    }
}
