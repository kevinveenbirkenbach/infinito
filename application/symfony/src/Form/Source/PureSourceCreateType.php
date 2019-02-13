<?php

namespace App\Form\Source;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author kevinfrantz
 */
final class PureSourceCreateType extends SourceType
{
    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('slug');
    }
}
