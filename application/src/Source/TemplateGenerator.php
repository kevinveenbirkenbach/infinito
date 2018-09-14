<?php

namespace App\Source;

use App\Entity\SourceInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
class TemplateGenerator
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
     * @var string
     */
    protected $format;

    public function __construct(SourceInterface $source, Request $request)
    {
        $this->source = $source;
        $this->request = $request;
        $this->format = $this->request->getRequestFormat();
    }

    public function getTemplatePath(): string
    {
        return self::SOURCE_TEMPLATE_ROOT.'/'.$this->generateName().'.'.$this->format.'.twig';
    }

    private function generateName(): string
    {
        $reflection = new \ReflectionClass($this->source);
        $shortName = $reflection->getShortName();
        $lowerName = strtolower($shortName);

        return str_replace('source', '', $lowerName);
    }
}
