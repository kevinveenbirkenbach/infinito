<?php

namespace App\Domain\ResponseManagement;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Meta\RightInterface;
use App\Domain\UserManagement\UserIdentityManager;
use Symfony\Component\Security\Core\User\UserInterface as CoreUserInterface;
use FOS\RestBundle\View\ViewHandlerInterface;
use App\Entity\Source\SourceInterface;
use FOS\RestBundle\View\View;
use App\Exception\AllreadyDefinedException;
use App\Domain\SecureCRUDManagement\CRUD\Read\SecureSourceReadService;

/**
 * @author kevinfrantz
 *
 * @todo Implement as a service!
 */
final class SourceRESTResponseManagerService implements SourceRESTResponseManagerServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RightInterface
     */
    private $requestedRight;

    /**
     * @var SourceInterface
     */
    private $loadedSource;
    
    /**
     * @var UserInterface
     */
    private $user;

    public function __construct(CoreUserInterface $user,SecureSourceReadService $secureSourceRead, EntityManagerInterface $entityManager, RightInterface $requestedRight)
    {
        $this->entityManager = $entityManager;
        $this->user = $user;
        $this->setRequestedRight($requestedRight);
        $this->setLoadedSource();
        $this->setView();
    }

    private function setView(): void
    {
        $this->view = new View($this->loadedSource, 200);
    }

    /**
     * @param RightInterface $requestedRight
     *
     * @throws AllreadyDefinedException
     */
    private function setRequestedRight(RightInterface $requestedRight): void
    {
        try {
            $requestedRight->getReciever();
            throw new AllreadyDefinedException('The reciever is allready defined.');
        } catch (\TypeError $error) {
            $requestedRight->setReciever($this->user->getSource());
            $this->requestedRight = $requestedRight;
        }
    }

    /**
     * {@inheritDoc}
     * @see \App\Domain\ResponseManagement\SourceRESTResponseManagerServiceInterface::getResponse()
     */
    public function getResponse(ViewHandlerInterface $viewHandler): Response
    {
        return $viewHandler->handle($this->view);
    }
}
