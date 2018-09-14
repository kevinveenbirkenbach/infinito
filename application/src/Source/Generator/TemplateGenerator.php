<?php

namespace App\Source\Generator;

use App\Entity\SourceInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
final class TemplateGenerator extends AbstractGenerator
{
    const SOURCE_TEMPLATE_ROOT = 'source';

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    public function __construct(Request $request, SourceInterface $source, \Twig_Environment $twig)
    {
        parent::__construct($request, $source);
        $this->twig = $twig;
    }

    public function render(): string
    {
        return $this->twig->render($this->getTemplatePath(), ['source' => $this->source]);
    }

    private function getTemplatePath(): string
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
