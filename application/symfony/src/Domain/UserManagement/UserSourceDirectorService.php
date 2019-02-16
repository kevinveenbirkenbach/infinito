<?php

namespace App\Domain\UserManagement;

use App\Entity\UserInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Security;
use App\Entity\Source\AbstractSource;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author kevinfrantz
 *
 * @todo Test!
 */
final class UserSourceDirectorService implements UserSourceDirectorServiceInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Security
     */
    private $security;

    /**
     * @param EntityManager $entityManagerInterface
     * @param Security      $security
     */
    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    /**
     * @return UserSourceDirectorInterface
     */
    private function getUserSourceDirector(): UserSourceDirectorInterface
    {
        $sourceRepository = $this->entityManager->getRepository(AbstractSource::class);
        $user = $this->security->getUser();

        return new UserSourceDirector($sourceRepository, $user);
    }

    /**
     * @todo Optimzed performance!
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->getUserSourceDirector()->getUser();
    }
}
