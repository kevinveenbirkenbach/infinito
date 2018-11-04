<?php

namespace App\Entity\Attribut;

use App\Entity\Meta\RecieverInterface;

/**
 * @author kevinfrantz
 */
trait RecieverAttribut
{
    /**
     * @var RecieverInterface
     */
    protected $reciever;

    public function setReciever(RecieverInterface $reciever): void
    {
        $this->reciever = $reciever;
    }

    public function getReciever(): RecieverInterface
    {
        return $this->reciever;
    }
}
