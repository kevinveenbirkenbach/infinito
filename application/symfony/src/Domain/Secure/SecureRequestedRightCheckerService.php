<?php

namespace Infinito\Domain\Secure;

use Doctrine\ORM\EntityManagerInterface;
use Infinito\Domain\Request\Right\RequestedRightInterface;
use Infinito\Domain\Right\RightTransformerServiceInterface;

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
     * @see \Infinito\Domain\Secure\SecureRequestedRightCheckerServiceInterface::check()
     */
    public function check(RequestedRightInterface $requestedRight): bool
    {
        $source = $requestedRight->getSource();
        $secureSourceChecker = new SecureSourceChecker($source);
        $transformedRequestedRight = $this->rightTransformerService->transform($requestedRight);

        return $secureSourceChecker->hasPermission($transformedRequestedRight);
    }
}
