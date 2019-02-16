<?php

namespace App\Domain\SecureManagement;

use App\Domain\RequestManagement\Right\RequestedRightInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\RightManagement\RightTransformerServiceInterface;

/**
 * @author kevinfrantz
 */
final class SecureRequestedRightCheckerService implements SecureRequestedRightCheckerServiceInterface
{
    /**
     * @var RightTransformerServiceInterface
     */
    private $rightTransformerService;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(RightTransformerServiceInterface $rightTransformerService)
    {
        $this->rightTransformerService = $rightTransformerService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface::check()
     */
    public function check(RequestedRightInterface $requestedRight): bool
    {
        $source = $requestedRight->getSource();
        $secureSourceChecker = new SecureSourceChecker($source);
        $transformedRequestedRight = $this->rightTransformerService->transform($requestedRight);

        return $secureSourceChecker->hasPermission($transformedRequestedRight);
    }
}