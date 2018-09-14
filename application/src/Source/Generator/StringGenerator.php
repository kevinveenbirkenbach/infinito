<?php

namespace App\Source\Generator;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\SourceInterface;

/**
 * @author kevinfrantz
 */
final class StringGenerator extends AbstractGenerator
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
        if (in_array($this->request->getRequestFormat(), SerializeGenerator::SERIALIZABLE_FORMATS)) {
            $serializeGenerator = new SerializeGenerator($this->request, $this->source);

            return $serializeGenerator->serialize();
        }
        $templateGenerator = new TemplateGenerator($this->request, $this->source, $this->twig);

        return $templateGenerator->render();
    }
}
