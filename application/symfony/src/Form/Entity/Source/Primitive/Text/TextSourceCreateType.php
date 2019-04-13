<?php

namespace Infinito\Form\Entity\Source\Primitive\Text;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Form\Entity\Source\SourceFormType;

/**
 * @author kevinfrantz
 */
class TextSourceCreateType extends SourceFormType
{
    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('text', TextType::class);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TextSource::class,
        ]);
    }
}
