<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\LawInterface;

/**
 * @author kevinfrantz
 *
 * @see LawAttributInterface
 */
trait LawAttribut
{
    /**
     * @var LawInterface
     */
    protected $law;

    public function setLaw(LawInterface $law): void
    {
        $this->law = $law;
    }

    public function getLaw(): LawInterface
    {
        return $this->law;
    }
}
