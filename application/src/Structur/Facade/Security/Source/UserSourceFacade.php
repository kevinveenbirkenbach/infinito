<?php

namespace App\Structur\Facade\Security\Source;

use App\Entity\NameSourceInterface;
use App\Entity\User;
use App\Entity\UserSourceInterface;
use App\DBAL\Types\RightType;
use App\DBAL\Types\LayerType;

/**
 * @author kevinfrantz
 */
class UserSourceFacade extends AbstractSourceFacade implements UserSourceInterface
{
    /**
     * @var UserSourceInterface
     */
    protected $source;

    public function setNameSource(NameSourceInterface $nameSource): void
    {
        throw new \Exception('The name source cant be changed!');
    }

    public function getNameSource(): NameSourceInterface
    {
        if ($this->isNameSourceGranted(RightType::READ, LayerType::SOURCE)) {
            //FILL! :)
        }
    }

    private function isNameSourceGranted(string $right, string $layer): bool
    {
        $nameSource = $this->source->getNameSource();
        $law = $nameSource->getNode()->getLaw();
        $userSourceNode = $this->source->getNode();

        return $this->isGranted($right, $layer) && $law->isGranted($userSourceNode, $layer, $right);
    }

    public function getUser(): User
    {
        //FILL
    }
    public function setUser(User $user): void
    {
        //FILL
    }

}
