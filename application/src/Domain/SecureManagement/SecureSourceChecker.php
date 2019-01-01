<?php

namespace App\Domain\SecureManagement;

use App\Entity\Meta\RightInterface;
use App\Entity\Source\SourceInterface;
use App\Domain\LawManagement\LawPermissionCheckerService;

/**
 * @author kevinfrantz
 */
final class SecureSourceChecker implements SecureSourceCheckerInterface
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    public function hasPermission(RightInterface $requestedRight): bool
    {
        $law = new LawPermissionCheckerService($this->source->getLaw());

        return $law->hasPermission($requestedRight);
    }
}
