<?php

namespace App\Domain\UserManagement;

use App\Entity\UserInterface;
use App\Entity\User;
use App\Repository\Source\SourceRepositoryInterface;
use App\Domain\FixtureManagement\FixtureSource\GuestUserFixtureSource;

/**
 * @author kevinfrantz
 */
final class UserSourceDirector implements UserSourceDirectorInterface
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var SourceRepositoryInterface
     */
    private $sourceRepository;

    /**
     * @param UserInterface $user
     */
    private function setUser(?UserInterface $user): void
    {
        if ($user) {
            $this->user = $user;

            return;
        }
        $this->user = new User();
        $this->user->setSource($this->sourceRepository->findOneBySlug(GuestUserFixtureSource::getSlug()));
    }

    /**
     * @param SourceRepositoryInterface $sourceRepository
     * @param UserInterface             $user
     */
    public function __construct(SourceRepositoryInterface $sourceRepository, ?UserInterface $user)
    {
        $this->sourceRepository = $sourceRepository;
        $this->setUser($user);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\UserManagement\UserSourceDirectorInterface::getUser()
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
