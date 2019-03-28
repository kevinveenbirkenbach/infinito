<?php

namespace Infinito\Domain\ParameterManagement\Parameter;

use Symfony\Component\Validator\Constraints as Assert;
use Infinito\Exception\UnvalidGetParameterException;

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
     * @var bool
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
        $type = gettype($value);
        switch ($type) {
            case 'NULL':
                // Use standart value
                $this->value = self::STANDART_VALUE;

                return;
            case 'boolean':
                $this->value = $value;

                return;
        }
        if (is_numeric($value)) {
            $value = (int) $value;
            if ($value >= 0 && $value <= 1) {
                $this->value = (bool) $value;

                return;
            }
        }
        throw new UnvalidGetParameterException("It\'s not possible to set <<$value>> of type <<".$type.'>> for class <<'.get_class().'>>. Just 0 and 1 are allowed!');
    }
}
