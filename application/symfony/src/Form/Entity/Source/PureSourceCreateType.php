<?php

namespace Infinito\Form\Entity\Source;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Infinito\Entity\Source\PureSource;
use Infinito\Attribut\SlugAttributInterface;
use Infinito\Attribut\ClassAttributInterface;

/**
 * @author kevinfrantz
 */
final class PureSourceCreateType extends SourceFormType
{
    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add(SlugAttributInterface::SLUG_ATTRIBUT_NAME)
        ->add(ClassAttributInterface::CLASS_ATTRIBUT_NAME, SourceFormType::class, [
            'mapped' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PureSource::class,
        ]);
    }
}
