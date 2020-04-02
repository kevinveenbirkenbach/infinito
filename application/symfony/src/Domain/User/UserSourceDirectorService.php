<?php

namespace Infinito\Domain\User;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Entity\UserInterface;
use Symfony\Component\Security\Core\Security;

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
     */
    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    private function getUserSourceDirector(): UserSourceDirectorInterface
    {
        $sourceRepository = $this->entityManager->getRepository(AbstractSource::class);
        $user = $this->security->getUser();

        return new UserSourceDirector($sourceRepository, $user);
    }

    /**
     * @todo Optimzed performance!
     */
    public function getUser(): UserInterface
    {
        return $this->getUserSourceDirector()->getUser();
    }
}
