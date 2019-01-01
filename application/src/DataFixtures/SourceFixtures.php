<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Source\Primitive\Text\TextSource;
use App\Entity\Source\Primitive\Text\TextSourceInterface;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Source\Complex\UserSource;
use App\Entity\Source\Complex\UserSourceInterface;
use App\Entity\Meta\Right;
use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;
use App\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 *
 * @todo Create a collection class for all users
 */
class SourceFixtures extends Fixture
{
    /**
     * @var TextSourceInterface The example source for the impressum
     */
    private $impressumSource;

    /**
     * @var UserSourceInterface The UserSource which should be used for the anonymous user
     */
    private $guestUserSource;

    public function load(ObjectManager $manager)
    {
        $this->setGuestUserSource();
        $this->setImpressumSource();
        $manager->persist($this->impressumSource);
        $manager->persist($this->getImpressumRight());
        $manager->persist($this->guestUserSource);
        $manager->flush();
    }

    private function setImpressumSource(): void
    {
        $this->impressumSource = new TextSource();
        $this->impressumSource->setText('Example Impressum');
        $this->impressumSource->setSlug(SystemSlugType::IMPRINT);
    }

    /**
     * @todo Implement that right gets automaticly created by persisting of law
     *
     * @return RightInterface
     */
    private function getImpressumRight(): RightInterface
    {
        $right = new Right();
        $right->setSource($this->impressumSource);
        $right->setLaw($this->impressumSource->getLaw());
        $right->setLayer(LayerType::SOURCE);
        $right->setType(RightType::READ);
        $right->setReciever($this->guestUserSource);

        return $right;
    }

    private function setGuestUserSource(): void
    {
        $this->guestUserSource = new UserSource();
        $this->guestUserSource->setSlug(SystemSlugType::GUEST_USER);
    }
}
