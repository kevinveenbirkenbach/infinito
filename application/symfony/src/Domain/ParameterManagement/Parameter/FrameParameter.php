<?php

namespace Infinito\Domain\ParameterManagement\Parameter;

use Symfony\Component\Validator\Constraints as Assert;
use Infinito\Exception\SetNotPossibleException;

/**
 * @author kevinfrantz
 */
final class FrameParameter extends AbstractParameter
{
    /**
     * @var bool The standart value which will be used
     */
    const STANDART_VALUE = true;

    /**
     * @var int|null
     * @Assert\Type("bool")
     */
    protected $value;

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ParameterManagement\Parameter\AbstractParameter::setValue()
     */
    public function setValue($value): void
    {
        if (is_null($value)) {
            //Use standart value
            $this->value = self::STANDART_VALUE;

            return;
        }
        if (is_numeric($value)) {
            $number = (int) $value;
            if ($number >= 0 && $number <= 1) {
                $this->value = (bool) $value;

                return;
            }
        }
        throw new SetNotPossibleException("It\'s not possible to set <<$value>> of type <<".gettype($value).'>> for class <<'.get_class().'>>. Just 0 and 1 are allowed!');
    }
}
