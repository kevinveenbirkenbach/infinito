<?php

namespace Infinito\Domain\Parameter\Parameter;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author kevinfrantz
 */
final class ViewParameter extends AbstractParameter
{
    /**
     * @var bool
     * @Assert\Choice(callback={"Infinito\DBAL\Types\ActionType","getValues"})
     */
    protected $value = null;
}
