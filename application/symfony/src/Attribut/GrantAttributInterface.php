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

    public function setGrant(bool $grant): void;

    public function getGrant(): bool;
}
