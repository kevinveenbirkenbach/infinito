<?php

namespace App\Creator\Factory\Template\Source;

/**
 * @author kevinfrantz
 */
final class SourceTemplateFormFactory extends SourceTemplateFactory
{
    const FORM_FOLDER = 'form';

    public function getTemplatePath(): string
    {
        return parent::SOURCE_TEMPLATE_ROOT.'/'.self::FORM_FOLDER.'/'.$this->generateName().'.'.$this->request->getRequestFormat().'.twig';
    }
}
