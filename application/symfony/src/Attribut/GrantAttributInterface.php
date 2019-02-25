<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 */
interface GrantAttributInterface
{
    /**
     * @var string
     */
    const GRANT_ATTRIBUT_NAME = 'grant';

    /**
     * @param bool $grant
     */
    public function setGrant(bool $grant): void;

    /**
     * @return bool
     */
    public function getGrant(): bool;
}
