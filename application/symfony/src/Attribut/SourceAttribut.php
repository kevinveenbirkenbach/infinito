<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
trait SourceAttribut
{
    /**
     * @var SourceInterface
     */
    protected $source;

    public function getSource(): SourceInterface
    {
        return $this->source;
    }

    public function setSource(SourceInterface $source): void
    {
        $this->source = $source;
    }
}
