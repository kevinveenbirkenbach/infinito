<?php

namespace Infinito\Domain\Law;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Infinito\Domain\Method\MethodPrefixType;
use Infinito\Domain\Right\RightChecker;
use Infinito\Domain\Source\SourceMemberInformation;
use Infinito\Entity\Meta\LawInterface;
use Infinito\Entity\Meta\RightInterface;
use Infinito\Entity\Source\SourceInterface;
use PhpCollection\CollectionInterface;

/**
 * @todo Implement checking by operation sources
 * @todo chek if recievers are still neccessary and if they should be implemented
 *
 * @author kevinfrantz
 */
final class LawPermissionChecker implements LawPermissionCheckerInterface
{
    /**
     * @var LawInterface
     */
    private $law;

    /**
     * @param Collection|RightInterface[] $rights
     *
     * @return Collection|RightInterface[]
     */
    private function getFilteredRights(Collection $rights, string $value, string $attribut): Collection
    {
        $result = new ArrayCollection();
        foreach ($rights as $right) {
            if ($right->{MethodPrefixType::GET.$attribut}() === $value) {
                $result->add($right);
            }
        }

        return $result;
    }

    /**
     * @param Collection|RightInterface[] $rights
     *
     * @return Collection|RightInterface[]
     */
    private function getRightsByActionType(Collection $rights, string $type): Collection
    {
        return $this->getFilteredRights($rights, $type, 'ActionType');
    }

    /**
     * @return bool True if right applies to all
     */
    private function doesRightApplyToAll(RightInterface $right): bool
    {
        return !$right->hasReciever();
    }

    /**
     * @param Collection|RightInterface[] $rights
     *
     * @return Collection|RightInterface[]
     */
    private function getRightsByReciever(Collection $rights, RightInterface $requestedRight): Collection
    {
        $result = new ArrayCollection();
        foreach ($rights as $right) {
            if ($this->doesRightApplyToAll($right) || $right->getReciever() === $requestedRight->getReciever() || $this->memberExist($right, $requestedRight->getReciever())) {
                $result->add($right);
            }
        }

        return $result;
    }

    /**
     * @todo Implement!
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
     */
    private function isGranted(Collection $rights, RightInterface $client): bool
    {
        if (0 === $rights->count()) {
            return $this->law->getGrant();
        }
        $right = $rights[0];
        $rightChecker = new RightChecker($right);

        return $rightChecker->isGranted($client->getLayer(), $client->getActionType(), $client->getReciever());
    }

    public function __construct(LawInterface $law)
    {
        $this->law = $law;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Law\LawPermissionCheckerInterface::hasPermission()
     */
    public function hasPermission(RightInterface $clientRight): bool
    {
        $rights = clone $this->law->getRights();
        $rights = $this->getRightsByActionType($rights, $clientRight->getActionType());
        $rights = $this->getRightsByLayer($rights, $clientRight->getLayer());
        $rights = $this->getRightsByReciever($rights, $clientRight);
        $rights = $this->sortByPriority($rights);

        return $this->isGranted($rights, $clientRight);
    }
}
