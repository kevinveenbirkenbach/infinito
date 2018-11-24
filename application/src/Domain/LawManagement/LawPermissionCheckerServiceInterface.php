<?php

namespace App\Domain\LawManagement;

use App\Entity\Source\SourceInterface;

/**
 * Allows to check if a source has rights on a source.
 *
 * @author kevinfrantz
 */
interface LawPermissionCheckerServiceInterface
{
    public function setRequestedSource(SourceInterface $requestedSource): void;

    public function setClientSource(SourceInterface $clientSource): void;

    public function checkPermission(): bool;

    /**
     * Sets the permission type.
     *
     * @param string $type
     */
    public function setType(string $type): void;
}
