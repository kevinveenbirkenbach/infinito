<?php
namespace App\Structur\Facade\Security\Source;

use App\Entity\Source\NameSourceInterface;
use App\Entity\Source\SourceInterface;
use App\Entity\UserInterface;
use App\Entity\Source\UserSourceInterface;
use App\DBAL\Types\RightType;
use App\DBAL\Types\LayerType;
use Doctrine\Common\Collections\Collection;

/**
 *
 * @author kevinfrantz
 */
class UserSourceFacade extends AbstractSourceFacade implements UserSourceInterface
{

    /**
     *
     * @var UserSourceInterface
     */
    protected $source;

    public function setNameSource(NameSourceInterface $nameSource): void
    {
        throw new \Exception('The name source cant be changed!');
    }

    public function getNameSource(): NameSourceInterface
    {
        if ($this->isNameSourceGranted(RightType::READ, LayerType::SOURCE)) {
            // FILL! :)
        }
    }

    private function isNameSourceGranted(string $right, string $layer): bool
    {
        $nameSource = $this->source->getNameSource();
        $law = $nameSource->getNode()->getLaw();
        $userSourceNode = $this->source->getNode();

        return $this->isGranted($right, $layer) && $law->isGranted($userSourceNode, $layer, $right);
    }

    public function getUser(): UserInterface
    {}

    public function setUser(UserInterface $user): void
    {}

    public function getVersion(): int
    {
    /**
     *
     * @todo Implement
     */
    }

    public function setVersion(int $version): void
    {
    /**
     *
     * @todo Implement
     */
    }

    public function setSource(SourceInterface $source): void
    {
    /**
     *
     * @todo Implement
     */
    }

    public function getGroupSources(): Collection
    {
    /**
     *
     * @todo Implement
     */
    }

    public function getSource(): SourceInterface
    {
    /**
     *
     * @todo Implement
     */
    }

    public function setGroupSources(Collection $groups): void
    {
    /**
     *
     * @todo Implement
     */
    }
}
