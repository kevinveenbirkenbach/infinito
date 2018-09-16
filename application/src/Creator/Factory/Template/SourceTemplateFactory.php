<?php

namespace App\Creator\Factory\Template;

use App\Entity\SourceInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Didn't know where to structure this file and how to name it.
 * Feel free to move it to a better place.
 *
 * @author kevinfrantz
 */
class SourceTemplateFactory
{
    const SOURCE_TEMPLATE_ROOT = 'source';

    /**
     * @var SourceInterface
     */
    protected $source;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source, Request $request)
    {
        $this->source = $source;
        $this->request = $request;
    }

    public function getTemplatePath(): string
    {
        return self::SOURCE_TEMPLATE_ROOT.'/'.$this->generateName().'.'.$this->request->getRequestFormat().'.twig';
    }

    private function generateName(): string
    {
        $reflection = new \ReflectionClass($this->source);
        $shortName = $reflection->getShortName();
        $lowerName = strtolower($shortName);

        return str_replace('source', '', $lowerName);
    }
}
