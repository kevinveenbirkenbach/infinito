<?php

namespace App\Attribut;

use App\Entity\Meta\LawInterface;

/**
 * @author kevinfrantz
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
