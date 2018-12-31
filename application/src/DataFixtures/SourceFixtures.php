<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Source\Primitive\Text\TextSource;
use App\Entity\Source\Primitive\Text\TextSourceInterface;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Source\Complex\UserSource;
use App\Entity\Source\Complex\UserSourceInterface;

class SourceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->getImpressum());
        $manager->persist($this->getGuestUser());
        $manager->flush();
    }

    /**
     * @return TextSourceInterface The example source for the impressum
     */
    private function getImpressum(): TextSourceInterface
    {
        $source = new TextSource();
        $source->setText('Example Impressum');
        $source->setSlug(SystemSlugType::IMPRINT);

        return $source;
    }

    /**
     * @return UserSourceInterface The UserSource which should be used for the anonymous user
     */
    private function getGuestUser(): UserSourceInterface
    {
        $source = new UserSource();
        $source->setSlug(SystemSlugType::GUEST_USER);

        return $source;
    }
}
