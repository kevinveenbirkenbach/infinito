<?php

namespace App\Source\Generator;

use App\Entity\SourceInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
abstract class AbstractGenerator
{
    /**
     * @var SourceInterface
     */
    protected $source;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request, SourceInterface $source)
    {
        $this->source = $source;
        $this->request = $request;
    }
}
