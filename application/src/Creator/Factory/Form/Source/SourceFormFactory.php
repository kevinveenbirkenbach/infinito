<?php

namespace App\Creator\Factory\Form\Source;

use Creator\Factory\AbstractSourceFactory;

/**
 * @author kevinfrantz
 */
final class SourceFormFactory extends AbstractSourceFactory
{
    const FORM_NAMESPACE = 'App\Form\\';

    public function getNamespace(): string
    {
        return self::FORM_NAMESPACE.$this->getName();
    }

    protected function getName(): string
    {
        return $this->getSourceClassShortName().'Type';
    }
}
