<?php
namespace App\Domain\UserManagement;

use App\Entity\UserInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Security;

/**
 * 
 * @author kevinfrantz
 * @todo Test!
 */
final class UserIdentityService implements UserIdentityServiceInterface
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
     * @var UserIdentityManagerInterface
     */
    private $userIdentityManager;
    
    /**
     * @param EntityManager $entityManager
     * @param Security $security
     */
    public function __construct(EntityManager $entityManager, Security $security){
        $this->entityManager = $entityManager;
        $this->security = $security;
    }
    
    private function setUserIdentityManager():void{
        $this->userIdentityManager = new UserIdentityManager($this->entityManager, $this->security->getUser());
    }
 
    /**
     * @todo Optimzed performance!
     * {@inheritDoc}
     * @see \App\Domain\UserManagement\UserIdentityManagerInterface::getUser()
     */
    public function getUser(): UserInterface
    {
        $this->setUserIdentityManager();
        return $this->userIdentityManager->getUser();
    }
}