<?php

namespace App\Domain\SecureCRUDManagement\CRUD\Read;

use App\Entity\Source\SourceInterface;
use App\Entity\Meta\RightInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use App\Domain\SecureManagement\SecureSourceChecker;
use App\Exception\SourceAccessDenied;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Source\AbstractSource;
use App\Domain\SecureCRUDManagement\CRUD\AbstractSecureCRUDService;
use App\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

/**
 * @author kevinfrantz
 */
final class SecureSourceReadService extends AbstractSecureCRUDService //implements SecureSourceReadServiceInterface
{
    /**
     * @todo It would be better to specify the type
     *
     * @var ObjectRepository
     */
    private $sourceRepository;

    /**
     * @param SourceInterface $source
     *
     * @return RightInterface
     */
    private function getClonedRightWithModifiedSource(SourceInterface $source, RightInterface $requestedRight): RightInterface
    {
        $requestedRight = clone $requestedRight;
        $requestedRight->setSource($source);

        return $requestedRight;
    }

    /**
     * @return SourceInterface
     */
    private function loadSource(): SourceInterface
    {
        try {
            return $this->sourceRepository->find($this->requestedRight->getSource()->getId());
        } catch (\Error $error) {
            return $this->sourceRepository->findOneBySlug($this->requestedRight->getSource()->getSlug());
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureCRUDManagement\AbstractSecureCRUDService::__construct()
     */
    public function __construct(RequestStack $requestStack, Security $security, EntityManagerInterface $entityManager)
    {
        $this->sourceRepository = $entityManager->getRepository(AbstractSource::class);
        parent::__construct($requestStack, $security, $entityManager);
    }

    /**
     * @param RightInterface $requestedRight
     *
     * @return EntityInterface
     */
    public function read(RightInterface $requestedRight): EntityInterface
    {
        $source = $this->loadSource();
        $requestedRight = $this->getClonedRightWithModifiedSource($source, $requestedRight);
        $secureSourceChecker = new SecureSourceChecker($source);
        if ($secureSourceChecker->hasPermission($requestedRight)) {
            return $source;
        }
        throw new SourceAccessDenied();
    }
}
