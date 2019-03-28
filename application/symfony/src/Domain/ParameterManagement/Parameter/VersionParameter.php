<?php

namespace Infinito\Domain\ParameterManagement\Parameter;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author kevinfrantz
 */
class VersionParameter extends AbstractParameter
{
    /**
     * @var int|null
     * @Assert\GreaterThan(0)
     * @Assert\Type("integer")
     */
    protected $value;
}
