<?php

namespace App\Domain\SecureLoadManagement;

use App\Entity\Source\SourceInterface;
use App\Entity\Meta\RightInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use App\Domain\SecureManagement\SecureSourceChecker;
use App\Exception\SourceAccessDenied;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Source\AbstractSource;

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

    public function __construct(EntityManagerInterface $entityManager, RightInterface $requestedRight)
    {
        $this->sourceRepository = $entityManager->getRepository(AbstractSource::class);
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
        $requestedRight = $this->getClonedRightWithModifiedSource($source);
        $secureSourceChecker = new SecureSourceChecker($source);
        if ($secureSourceChecker->hasPermission($requestedRight)) {
            return $source;
        }
        throw new SourceAccessDenied();
    }
}
