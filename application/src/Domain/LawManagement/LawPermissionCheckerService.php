<?php

namespace App\Domain\LawManagement;

use App\Entity\Source\SourceInterface;
use PhpCollection\CollectionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Meta\RightInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @todo Implement checking by operation sources
 *
 * @author kevinfrantz
 */
class LawPermissionCheckerService implements LawPermissionCheckerServiceInterface
{
    /**
     * @var SourceInterface
     */
    private $clientSource;

    /**
     * @var SourceInterface
     */
    private $requestedSource;

    /**
     * @var
     */
    private $permissionType;

    private function getRightsByPermission(Collection $rights): Collection
    {
        $result = new ArrayCollection();
        /*
         * @var RightInterface
         */
        foreach ($rights as $right) {
            if ($right->getType() === $this->permissionType) {
                $result->add($right);
            }
        }

        return $result;
    }

    private function getRightsByClient(Collection $rights): Collection
    {
        $result = new ArrayCollection();
        /*
         * @var RightInterface
         */
        foreach ($rights as $right) {
            if ($right->getReciever() === $this->clientSource) {
                $result->add($right);
            }
        }

        return $result;
    }

    /**
     * @todo Implement
     *
     * @return CollectionInterface the sources to which the client belongs to
     */
    private function getAllClientMemberships(): Collection
    {
    }

    private function sortByPriority(Collection $rights): Collection
    {
    }

    /**
     * @todo Implement priority function for locking
     *
     * @param CollectionInterface $rights the rights which exist
     *
     * @return bool
     */
    private function isGranted(CollectionInterface $rights): bool
    {
        /*
         * @var RightInterface
         */
        foreach ($rights as $right) {
            if ($clientSources->contains($right)) {
            }
        }

        return $result;
    }

    public function checkPermission(): bool
    {
        $requestedSourceRights = $this->requestedSource->getLaw()->getRights();
        $rightsByPermission = $this->getRightsByPermission($requestedSourceRights);
        $rightsbyClient = $this->getRightsByClient($rightsByPermission);
    }

    public function setClientSource(SourceInterface $clientSource): void
    {
        $this->clientSource = $clientSource;
    }

    public function setRequestedSource(SourceInterface $requestedSource): void
    {
        $this->requestedSource = $requestedSource;
    }

    public function setType(string $type): void
    {
        $this->permissionType = $type;
    }
}
