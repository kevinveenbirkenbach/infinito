<?php

namespace App\Domain\UserManagement;

use App\Entity\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\DBAL\Types\SystemSlugType;
use App\Entity\User;
use App\Repository\Source\SourceRepository;

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
     * @var SourceRepository
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
        $this->user->setSource($this->sourceRepository->findOneBySlug(SystemSlugType::GUEST_USER));
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param UserInterface          $user
     */
    public function __construct(SourceRepository $sourceRepository, ?UserInterface $user)
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
