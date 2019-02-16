<?php

namespace App\Attribut;

use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 *
 * @see RecieverAttributInterface
 */
trait RecieverAttribut
{
    /**
     * @var SourceInterface
     */
    protected $reciever;

    /**
     * @param SourceInterface $reciever
     */
    public function setReciever(?SourceInterface $reciever): void
    {
        $this->reciever = $reciever;
    }

    /**
     * @return SourceInterface
     */
    public function getReciever(): SourceInterface
    {
        return $this->reciever;
    }

    /**
     * @return bool
     */
    public function hasReciever(): bool
    {
        return isset($this->reciever);
    }
}
