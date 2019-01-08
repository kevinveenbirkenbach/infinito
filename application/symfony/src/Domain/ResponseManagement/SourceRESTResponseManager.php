<?php

namespace App\Domain\ResponseManagement;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Meta\RightInterface;
use App\Domain\UserManagement\UserIdentityManager;
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
final class SourceRESTResponseManager implements SourceRESTResponseManagerInterface
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RightInterface
     */
    private $requestedRight;

    /**
     * @var ViewHandlerInterface
     */
    private $viewHandler;

    /**
     * @var SourceInterface
     */
    private $loadedSource;

    /**
     * @var View
     */
    private $view;

    /**
     * @param UserInterface          $user
     * @param EntityManagerInterface $entityManager
     * @param RightInterface         $requestedRight
     * @param ViewHandlerInterface   $viewHandler
     */
    public function __construct(?UserInterface $user, EntityManagerInterface $entityManager, RightInterface $requestedRight, ViewHandlerInterface $viewHandler)
    {
        $this->entityManager = $entityManager;
        $this->viewHandler = $viewHandler;
        $this->setUser($user);
        $this->setRequestedRight($requestedRight);
        $this->setLoadedSource();
        $this->setView();
    }

    private function setView(): void
    {
        $this->view = new View($this->loadedSource, 200);
    }

    private function setLoadedSource(): void
    {
        $secureSourceLoader = new SecureSourceReadService($this->entityManager, $this->requestedRight);
        $this->loadedSource = $secureSourceLoader->getSource();
    }

    /**
     * @param UserInterface $user
     */
    private function setUser(?UserInterface $user): void
    {
        $userIdentityManager = new UserIdentityManager($this->entityManager, $user);
        $this->user = $userIdentityManager->getUser();
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
     * {@inheritdoc}
     *
     * @see \App\Domain\ResponseManagement\SourceRESTResponseManagerInterface::getResponse()
     */
    public function getResponse(): Response
    {
        return $this->viewHandler->handle($this->view);
    }
}
