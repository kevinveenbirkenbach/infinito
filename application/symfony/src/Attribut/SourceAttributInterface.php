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

    public function getSource(): SourceInterface;

    public function setSource(SourceInterface $source): void;
}
