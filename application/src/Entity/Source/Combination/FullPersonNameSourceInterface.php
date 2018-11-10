<?php

namespace App\Entity\Source\Combination;

use App\Entity\Source\Data\Name\FirstNameSourceInterface;
use App\Entity\Source\Data\Name\SurnameSourceInterface;

/**
 * @todo Maybe a middle name would be helpfull in the future ;)
 *
 * @author kevinfrantz
 */
interface FullPersonNameSourceInterface extends CombinationSourceInterface
{
    public function getFirstName(): FirstNameSourceInterface;

    public function setFirstName(FirstNameSourceInterface $name): void;

    public function getSurname(): SurnameSourceInterface;

    public function setSurname(SurnameSourceInterface $name): void;
}
