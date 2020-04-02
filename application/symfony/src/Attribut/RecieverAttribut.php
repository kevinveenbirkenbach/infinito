<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\SourceInterface;

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

    public function getReciever(): SourceInterface
    {
        return $this->reciever;
    }

    public function hasReciever(): bool
    {
        return isset($this->reciever);
    }
}
