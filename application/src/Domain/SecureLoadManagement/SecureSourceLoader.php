<?php

namespace App\Domain\SecureLoadManagement;

use App\Entity\Source\SourceInterface;
use App\Entity\Meta\RightInterface;
use App\Domain\LawManagement\LawPermissionCheckerService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * @author kevinfrantz
 */
final class SecureSourceLoader implements SecureSourceLoaderInterface
{
    /**
     * @todo It would be better to specify the type
     *
     * @var ObjectRepository
     */
    private $sourceRepository;

    /**
     * The source attribute of the right needs a slug OR id.
     *
     * @var RightInterface the right which is requested
     */
    private $requestedRight;

    /**
     * @param SourceInterface $source
     *
     * @return RightInterface
     */
    private function getClonedRightWithModifiedSource(SourceInterface $source): RightInterface
    {
        $requestedRight = clone $this->requestedRight;
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
            return $this->sourceRepository->findOneBy(['slug' => $this->requestedRight->getSource()->getSlug()]);
        }
    }

    private function hasPermission(SourceInterface $source): bool
    {
        $requestedRight = $this->getClonedRightWithModifiedSource($source);
        $law = new LawPermissionCheckerService($source->getLaw());

        return $law->hasPermission($requestedRight);
    }

    public function __construct(ObjectRepository $sourceRepository, RightInterface $requestedRight)
    {
        $this->sourceRepository = $sourceRepository;
        $this->requestedRight = $requestedRight;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureLoadManagement\SecureSourceLoaderInterface::getSource()
     */
    public function getSource(): SourceInterface
    {
        $source = $this->loadSource();
        if ($this->hasPermission($source)) {
            return $source;
        }
        throw new AccessDeniedHttpException();
    }
}
