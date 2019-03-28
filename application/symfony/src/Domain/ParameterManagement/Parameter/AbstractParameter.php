<?php

namespace Infinito\Domain\ParameterManagement\Parameter;

/**
 * Parameter classes shouldn't throw exceptions!
 *
 * @author kevinfrantz
 */
abstract class AbstractParameter implements ParameterInterface
{
    /**
     * Use Annotations in child classes for validation.
     *
     * @see https://symfony.com/doc/current/validation.html
     *
     * @var mixed
     */
    protected $value;

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ParameterManagement\Parameter\ParameterInterface::getValue()
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ParameterManagement\Parameter\ParameterInterface::setValue()
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return string the parameter key
     */
    public static function getKey(): string
    {
        $className = get_called_class();
        $exploded = explode('\\', $className);
        $shortname = $exploded[count($exploded) - 1];
        $key = str_replace('Parameter', '', $shortname);
        $lower = strtolower($key);

        return $lower;
    }
}
