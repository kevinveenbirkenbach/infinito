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

    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    public function getVersion(): int
    {
        return $this->version;
    }
}
