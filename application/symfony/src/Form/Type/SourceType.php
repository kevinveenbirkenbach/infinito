<?php

namespace Infinito\Form\Type;

use Infinito\Domain\Source\SourceClassInformationService;
use Infinito\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author kevinfrantz
 */
final class SourceType extends AbstractType implements SourceTypeInterface
{
    const UNUSED_PRAEFIX = 'Infinito\\Entity\\Source';

    /**
     * @return string Key which can be used in choice selection
     */
    private function getChoiceKey(string $class): string
    {
        return str_replace(self::UNUSED_PRAEFIX, '', $class);
    }

    private function getChoices(): array
    {
        $choices = [];
        $sourceClassInformationService = new SourceClassInformationService();
        $allClasses = $sourceClassInformationService->getAllSourceClasses();
        foreach ($allClasses as $class) {
            $choices[$this->getChoiceKey($class)] = $class;
        }

        return $choices;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => $this->getChoices(),
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Form\AbstractType::getParent()
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
