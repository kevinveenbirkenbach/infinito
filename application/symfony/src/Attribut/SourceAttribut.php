<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 *
 * @see SourceAttributInterface
 */
trait SourceAttribut
{
    /**
     * @var SourceInterface
     */
    protected $source;

    /**
     * @return SourceInterface
     */
    public function getSource(): SourceInterface
    {
        return $this->source;
    }

    /**
     * @param SourceInterface $source
     */
    public function setSource(SourceInterface $source): void
    {
        $this->source = $source;
    }
}
