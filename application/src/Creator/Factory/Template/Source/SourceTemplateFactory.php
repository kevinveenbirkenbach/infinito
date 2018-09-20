<?php

namespace App\Creator\Factory\Template\Source;

use App\Entity\SourceInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
class SourceTemplateFactory
{
    const SOURCE_TEMPLATE_ROOT = 'source';

    const VIEW_FOLDER = 'view';

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
        return self::SOURCE_TEMPLATE_ROOT.'/'.self::VIEW_FOLDER.'/'.$this->generateName().'.'.$this->request->getRequestFormat().'.twig';
    }

    protected function generateName(): string
    {
        $reflection = new \ReflectionClass($this->source);
        $shortName = $reflection->getShortName();
        $lowerName = strtolower($shortName);

        return str_replace('source', '', $lowerName);
    }
}
