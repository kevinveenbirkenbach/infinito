<?php

namespace App\Source\Generator;

use App\Entity\SourceInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Creator\Factory\Template\SourceTemplateFactory;

/**
 * @author kevinfrantz
 */
final class TemplateGenerator extends AbstractGenerator
{
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
        $templatePathFactory = new SourceTemplateFactory($this->source, $this->request);

        return $this->twig->render($templatePathFactory->getTemplatePath(), ['source' => $this->source]);
    }
}
