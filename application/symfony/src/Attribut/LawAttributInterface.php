<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\LawInterface;

/**
 * @author kevinfrantz
 */
interface LawAttributInterface
{
    public function setLaw(LawInterface $law): void;

    public function getLaw(): LawInterface;
}
