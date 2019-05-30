<?php

namespace Infinito\Domain\Source;

use Infinito\Entity\Meta\RightInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Entity\Meta\Law;
use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Exception\Attribut\AllreadyDefinedAttributException;
use Infinito\Exception\Collection\ContainsElementException;
use Infinito\Exception\Collection\NotSetElementException;
use Infinito\Domain\Method\MethodPrefixType;

/**
 * @author kevinfrantz
 */
final class SourceRightManager implements SourceRightManagerInterface
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

    /**
     * @throws AllreadyDefinedAttributException If the attribut is allready defined
     */
    private function checkRightAttributes(RightInterface $right): void
    {
        $attributes = ['source', 'law'];
        foreach ($attributes as $attribut) {
            try {
                $right->{MethodPrefixType::GET.ucfirst($attribut)}();
                throw new AllreadyDefinedAttributException("The attribut \"$attribut\" is allready defined!");
            } catch (\Error $error) {
                //Expected
            }
        }
    }

    /**
     * @return ArrayCollection|RightInterface[]
     */
    private function getRights(): ArrayCollection
    {
        return $this->source->getLaw()->getRights();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\SourceRightManagerInterface::addRight()
     */
    public function addRight(RightInterface $right): void
    {
        if ($this->getRights()->contains($right)) {
            throw new ContainsElementException('The right was allready added.');
        }
        $this->checkRightAttributes($right);
        $right->setSource($this->source);
        $right->setLaw($this->source->getLaw());
        $this->getRights()->add($right);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\SourceRightManagerInterface::removeRight()
     */
    public function removeRight(RightInterface $right): void
    {
        $right->setSource(new class() extends AbstractSource {
        });
        $right->setLaw(new Law());
        if (!$this->getRights()->removeElement($right)) {
            throw new NotSetElementException('The right to remove is not set.');
        }
    }
}
