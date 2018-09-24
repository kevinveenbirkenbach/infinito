<?php

namespace App\Entity\Attribut;

use App\Entity\Interfaces\RecieverGroupInterface;

/**
 * @author kevinfrantz
 */
trait RecieverGroupAttribut
{
    /**
     * @var RecieverGroupInterface
     */
    protected $recieverGroup;

    public function setRecieverGroup(RecieverGroupInterface $recieverGroup): void
    {
        $this->recieverGroup = $recieverGroup;
    }

    public function getRecieverGroup(): RecieverGroupInterface
    {
        return $this->recieverGroup;
    }
}
