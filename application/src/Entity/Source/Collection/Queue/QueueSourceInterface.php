<?php

namespace App\Entity\Source\Collection\Queue;

use App\Entity\Attribut\MembersAttributInterface;
use App\Entity\Source\Collection\CollectionSourceInterface;
use App\Entity\Source\SourceInterface;

/**
 * @todo Implement integration test for two user accessing queue! Check if log works!
 *
 * @author kevinfrantz
 */
interface QueueSourceInterface extends CollectionSourceInterface, MembersAttributInterface
{
    public function getPointerPosition(): int;

    public function getNextElement(): SourceInterface;
}
