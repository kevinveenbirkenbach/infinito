<?php

namespace Infinito\Domain\Form;

/**
 * @author kevinfrantz
 */
interface FormClassNameServiceInterface
{
    /**
     * @return string The name of the form of the entity
     */
    public function getClass(string $origineClass, string $type = ''): string;
}
