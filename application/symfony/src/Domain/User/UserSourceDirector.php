<?php

namespace Infinito\Domain\User;

use Infinito\Entity\UserInterface;
use Infinito\Entity\User;
use Infinito\Repository\Source\SourceRepositoryInterface;
use Infinito\Domain\Fixture\FixtureSource\GuestUserFixtureSource;

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
     * @see \Infinito\Domain\User\UserSourceDirectorInterface::getUser()
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
