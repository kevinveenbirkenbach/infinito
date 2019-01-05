<?php

namespace App\Domain\UserManagement;

use App\Entity\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\DBAL\Types\SystemSlugType;
use App\Entity\User;
use App\Entity\Source\AbstractSource;
use App\Repository\Source\SourceRepository;

/**
 * @author kevinfrantz
 */
final class UserIdentityManager implements UserIdentityManagerInterface
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
     * @param EntityManagerInterface $entityManager
     */
    private function setSourceRepository(EntityManagerInterface $entityManager): void
    {
        $this->sourceRepository = $entityManager->getRepository(AbstractSource::class);
    }

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
    public function __construct(EntityManagerInterface $entityManager, ?UserInterface $user)
    {
        $this->setSourceRepository($entityManager);
        $this->setUser($user);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\UserManagement\UserIdentityManagerInterface::getUser()
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
