<?php

namespace App\Attribut;

use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
trait RecieverAttribut
{
    /**
     * @var SourceInterface
     */
    protected $reciever;

    public function setReciever(SourceInterface $reciever): void
    {
        $this->reciever = $reciever;
    }

    public function getReciever(): SourceInterface
    {
        return $this->reciever;
    }
}
