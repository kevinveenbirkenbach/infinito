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

    /**
     * @param LawInterface $law
     */
    public function setLaw(LawInterface $law): void
    {
        $this->law = $law;
    }

    /**
     * @return LawInterface
     */
    public function getLaw(): LawInterface
    {
        return $this->law;
    }
}
