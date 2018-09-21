<?php
namespace App\Structur\Facade\Security;

use App\Entity\NodeInterface;
use App\Entity\SourceInterface;
use App\Entity\User;
use App\DBAL\Types\RightType;
use App\DBAL\Types\LayerType;

/**
 *
 * @author kevinfrantz
 *        
 */
abstract class AbstractSourceFasade implements SourceInterface
{
    /**
     *
     * @var User
     */
    protected static $user;

    /**
     *
     * @var SourceInterface
     */
    protected $source;

    public static function setUser(User $user): void
    {
        self::$user = $user;
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
        if($this->isGranted(RightType::READ)){
            return $source->getId();
        }
    }

    public function getNode(): NodeInterface
    {
        if($this->isGranted(RightType::READ,LayerType::NODE)){
            return $source->getId();
        }
    }

    protected function isGranted(string $right,string $layer): bool
    {
        return $this->getNode()
            ->getLaw()
            ->isGranted(self::$user->getSource()
            ->getNode(), self::$layer, $right);
    }
}

