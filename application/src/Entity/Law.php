<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\Attribut\RightsAttribute;
use Doctrine\Common\Collections\ArrayCollection;
use App\DBAL\Types\RightType;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="law")
 * @ORM\Entity(repositoryClass="App\Repository\LawRepository")
 */
class Law extends AbstractEntity implements LawInterface
{
    use RightsAttribute;

    /**
     *
     * @ORM\OneToMany(targetEntity="Right", mappedBy="id", cascade={"persist", "remove"})
     * @var ArrayCollection
     */
    protected $rights;

    public function __construct()
    {
        parent::__contruct();
        $this->initAllRights();
    }

    private function initAllRights(): void
    {
        foreach (RightType::getChoices() as $key=>$value){
            $right = new Right();
            $right->setType($value);
            $this->rights->set($key, $right);
        }
    }

}

