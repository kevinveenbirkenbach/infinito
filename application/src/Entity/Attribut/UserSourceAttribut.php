<?php

namespace Entity\Attribut;

use App\Entity\Source\UserSourceInterface;

/**
 * @author kevinfrantz
 */
trait UserSource
{
    /**
     * @var UserSourceInterface
     * @ORM\OneToOne(targetEntity="UserSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_user_id", referencedColumnName="id")
     */
    protected $userSource;

    public function setUserSource(UserSourceInterface $userSource): void
    {
        $this->user = $userSource;
    }

    public function getUserSource(): UserSourceInterface
    {
        return $this->userSource;
    }
}
