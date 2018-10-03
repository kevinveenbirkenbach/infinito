<?php

namespace App\Structur\Facade\Security\Source;

use App\Entity\NodeInterface;
use App\Entity\Source\SourceInterface;
use App\Entity\User;
use App\DBAL\Types\RightType;
use App\DBAL\Types\LayerType;
use App\Structur\Facade\Security\Source\SourceFacadeInterface;

/**
 * @author kevinfrantz
 */
abstract class AbstractSourceFacade implements SourceFacadeInterface
{
    /**
     * Propably it woul be better to solve this over the constructor
     * @var User
     */
    protected static $facadeUser;

    /**
     * @var SourceInterface
     */
    protected $source;

    public static function setFacadeUser(User $facadeUser): void
    {
        self::$facadeUser = $facadeUser;
    }

    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    public function setId(int $id): void
    {
        throw \Exception("The id can't be changed!");
    }

    public function setNode(NodeInterface $node): void
    {
        throw \Exception("The node can't be changed!");
    }

    public function getId(): int
    {
        if ($this->isGranted(RightType::READ)) {
            return $source->getId();
        }
    }

    public function getNode(): NodeInterface
    {
        if ($this->isGranted(RightType::READ, LayerType::NODE)) {
            return $source->getNode();
        }
    }

    protected function isGranted(string $right, string $layer): bool
    {
        return $this->getNode()
            ->getLaw()
            ->isGranted(self::$user->getSource()
            ->getNode(), self::$layer, $right);
    }

    protected function lazyLoadSourceFacade(SourceInterface $source)
    {
    }
}
