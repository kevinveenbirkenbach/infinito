<?php

namespace App\Creator\Factory;

use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
abstract class AbstractSourceFactory
{
    /**
     * @var SourceInterface
     */
    protected $source;

    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    protected function getSourceClassShortName(): string
    {
        $reflection = new \ReflectionClass($this->source);

        return $reflection->getShortName();
    }
}
