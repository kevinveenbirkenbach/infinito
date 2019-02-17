<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
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
