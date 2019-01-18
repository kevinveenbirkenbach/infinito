<?php

namespace App\Domain\LawManagement;

use PhpCollection\CollectionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Meta\RightInterface;
use Doctrine\Common\Collections\Collection;
use App\Entity\Meta\LawInterface;
use App\Domain\RightManagement\RightChecker;
use App\Entity\Source\SourceInterface;
use App\Domain\SourceManagement\SourceMemberInformation;

/**
 * @todo Implement checking by operation sources
 * @todo chek if recievers are still neccessary and if they should be implemented
 *
 * @author kevinfrantz
 */
final class LawPermissionCheckerService implements LawPermissionCheckerServiceInterface
{
    /**
     * @var LawInterface
     */
    private $law;

    /**
     * @param Collection|RightInterface[] $rights
     * @param string                      $value
     * @param string                      $attribut
     *
     * @return Collection|RightInterface[]
     */
    private function getFilteredRights(Collection $rights, string $value, string $attribut): Collection
    {
        $result = new ArrayCollection();
        foreach ($rights as $right) {
            if ($right->{'get'.$attribut}() === $value) {
                $result->add($right);
            }
        }

        return $result;
    }

    /**
     * @param Collection|RightInterface[] $rights
     * @param string                      $type
     *
     * @return Collection|RightInterface[]
     */
    private function getRightsByCrud(Collection $rights, string $type): Collection
    {
        return $this->getFilteredRights($rights, $type, 'Crud');
    }

    /**
     * @param Collection|RightInterface[] $rights
     * @param SourceInterface             $reciever
     *
     * @return Collection|RightInterface[]
     */
    private function getRightsByReciever(Collection $rights, SourceInterface $reciever): Collection
    {
        $result = new ArrayCollection();
        foreach ($rights as $right) {
            if ($right->getReciever() === $reciever || $this->memberExist($right, $reciever)) {
                $result->add($right);
            }
        }

        return $result;
    }

    /**
     * @todo Implement!
     *
     * @param RightInterface  $right
     * @param SourceInterface $recieverSource
     *
     * @return bool
     */
    private function memberExist(RightInterface $right, SourceInterface $recieverSource): bool
    {
        $rightMemberInformation = new SourceMemberInformation($right->getReciever());
        $rightMemberSources = $rightMemberInformation->getAllMembers();
        foreach ($rightMemberSources as $memberSource) {
            if ($memberSource === $recieverSource) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Collection|RightInterface[] $rights
     * @param string                      $layer
     *
     * @return Collection|RightInterface[]
     */
    private function getRightsByLayer(Collection $rights, string $layer): Collection
    {
        return $this->getFilteredRights($rights, $layer, 'Layer');
    }

    /**
     * @todo seems like this can be solved on a nicer way
     *
     * @param Collection|RightInterface[] $rights
     *
     * @return Collection|RightInterface[]
     */
    private function sortByPriority(Collection $rights): Collection
    {
        $iterator = $rights->getIterator();
        $iterator->uasort(function ($first, $second) {
            return (int) $first->getPriority() > (int) $second->getPriority() ? 1 : -1;
        });
        $sorted = new ArrayCollection();
        foreach ($iterator as $right) {
            $sorted->add($right);
        }

        return $sorted;
    }

    /**
     * @param CollectionInterface|RightInterface[] $rights
     *                                                     the rights which exist
     *
     * @return bool
     */
    private function isGranted(Collection $rights, RightInterface $client): bool
    {
        if (0 === $rights->count()) {
            return $this->law->getGrant();
        }
        $right = $rights[0];
        $rightChecker = new RightChecker($right);

        return $rightChecker->isGranted($client->getLayer(), $client->getCrud(), $client->getReciever());
    }

    /**
     * @param LawInterface $law
     */
    public function __construct(LawInterface $law)
    {
        $this->law = $law;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\LawManagement\LawPermissionCheckerServiceInterface::hasPermission()
     */
    public function hasPermission(RightInterface $clientRight): bool
    {
        $rights = clone $this->law->getRights();
        $rights = $this->getRightsByCrud($rights, $clientRight->getCrud());
        $rights = $this->getRightsByLayer($rights, $clientRight->getLayer());
        $rights = $this->getRightsByReciever($rights, $clientRight->getReciever());
        $rights = $this->sortByPriority($rights);

        return $this->isGranted($rights, $clientRight);
    }
}
