<?php

namespace Infinito\Entity\Source\Complex;

use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\UserAttribut;
use Infinito\Entity\UserInterface;
use Infinito\Attribut\PersonIdentitySourceAttribut;
use Infinito\Entity\Meta\Right;
use Infinito\Domain\User\UserSourceStandartRightMapInterface;

/**
 * @author kevinfrantz
 * @ORM\Entity(repositoryClass="Infinito\Repository\Source\Complex\UserSourceRepository")
 */
class UserSource extends AbstractComplexSource implements UserSourceInterface
{
    use UserAttribut,PersonIdentitySourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="Infinito\Entity\User",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * @ORM\OneToOne(targetEntity="PersonIdentitySource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="identity_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var PersonIdentitySourceInterface
     */
    protected $personIdentitySource;

    /**
     * This function sets the standart rights for a user source.
     */
    private function setStandartRights(): void
    {
        foreach (UserSourceStandartRightMapInterface::LAYER_RIGHT_MAP as $layer => $actions) {
            foreach ($actions as $action) {
                $law = $this->law;
                $right = new Right();
                $right = new Right();
                $right->setSource($this);
                $right->setLaw($law);
                $right->setReciever($this);
                $right->setLayer($layer);
                $right->setActionType($action);
                $rights = $law->getRights();
                $rights->add($right);
            }
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->setStandartRights();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Entity\Source\Complex\UserSourceInterface::hasPersonIdentitySource()
     */
    public function hasPersonIdentitySource(): bool
    {
        return isset($this->personIdentitySource);
    }
}
