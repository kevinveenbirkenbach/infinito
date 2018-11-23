<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Source\Primitive\Text\TextSource;
use App\Entity\Source\Primitive\Text\TextSourceInterface;
use App\DBAL\Types\SystemSlugType;

class SourceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->getImpressum());
        $manager->flush();
    }

    private function getImpressum(): TextSourceInterface
    {
        $source = new TextSource();
        $source->setText('Example Impressum');
        $source->setSlug(SystemSlugType::IMPRINT);

        return $source;
    }
}
