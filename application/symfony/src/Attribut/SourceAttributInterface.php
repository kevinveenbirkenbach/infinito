<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
interface SourceAttributInterface
{
    /**
     * @var string
     */
    const SOURCE_ATTRIBUT_NAME = 'source';

    /**
     * @return SourceInterface
     */
    public function getSource(): SourceInterface;

    /**
     * @param SourceInterface $source
     */
    public function setSource(SourceInterface $source): void;
}
