<?php

namespace App\Form\Source;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Source\PureSource;
use App\Attribut\SlugAttributInterface;
use App\Attribut\ClassAttributInterface;

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
        $builder
        ->add(SlugAttributInterface::SLUG_ATTRIBUT_NAME)
        ->add(ClassAttributInterface::CLASS_ATTRIBUT_NAME, SourceType::class, [
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
