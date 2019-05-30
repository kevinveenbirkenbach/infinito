<?php

namespace Infinito\Domain\Parameter\Parameter;

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
