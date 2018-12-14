<?php

namespace App\Entity\Attribut;

use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
interface RecieverAttributInterface
{
    public function setReciever(SourceInterface $reciever): void;

    public function getReciever(): SourceInterface;
}
