<?php

namespace App\Entity\Attribut;

/**
 * @author kevinfrantz
 */
trait RecieverAttribut
{
    /**
     * @var string
     */
    protected $reciever;

    public function setReciever(string $type): void
    {
        $this->reciever = $type;
    }

    public function getReciever(): string
    {
        return $this->reciever;
    }
}
