<?php

namespace App\Creator\Factory;

use App\Entity\SourceInterface;

/**
 * @author kevinfrantz
 */
class AbstractSourceFactory
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
