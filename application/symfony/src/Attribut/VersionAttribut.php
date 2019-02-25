<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 *
 * @see VersionAttributInterface
 */
trait VersionAttribut
{
    /**
     * @var int
     */
    protected $version;

    /**
     * @param int $version
     */
    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }
}
