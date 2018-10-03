<?php

namespace App\Creator\Factory\Template\Source;

use App\Entity\Source\SourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Creator\Factory\AbstractSourceFactory;

/**
 * @author kevinfrantz
 */
class SourceTemplateFactory extends AbstractSourceFactory
{
    const SOURCE_TEMPLATE_ROOT = 'source';

    const VIEW_FOLDER = 'view';

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source, Request $request)
    {
        parent::__construct($source);
        $this->request = $request;
    }

    public function getTemplatePath(): string
    {
        return self::SOURCE_TEMPLATE_ROOT.'/'.self::VIEW_FOLDER.'/'.$this->generateName().'.'.$this->request->getRequestFormat().'.twig';
    }

    protected function generateName(): string
    {
        $lowerName = strtolower($this->getSourceClassShortName());

        return str_replace('source', '', $lowerName);
    }
}
