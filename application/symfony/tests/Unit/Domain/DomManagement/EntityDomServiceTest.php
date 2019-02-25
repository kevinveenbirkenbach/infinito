<?php

namespace tests\Unit\Domain\DomManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\DomManagement\EntityDomServiceInterface;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityServiceInterface;
use Infinito\Domain\DomManagement\EntityDomService;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Attribut\SlugAttributInterface;
use Infinito\Attribut\IdAttributInterface;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Attribut\VersionAttributInterface;

/**
 * @author kevinfrantz
 */
class EntityDomServiceTest extends TestCase
{
    /**
     * @var EntityDomServiceInterface
     */
    private $entityDomService;

    /**
     * @var RequestedEntityServiceInterface
     */
    private $requestedEntityService;

    public function setUp(): void
    {
        $this->requestedEntityService = $this->createMock(RequestedEntityServiceInterface::class);
        $this->entityDomService = new EntityDomService($this->requestedEntityService);
    }

    public function testAbstractSource(): void
    {
        $slug = 'test';
        $id = 12345;
        $source = new class() extends AbstractSource {
        };
        $source->setSlug($slug);
        $source->setId($id);
        $source->getCreatorRelation()->setId(1);
        $source->getMemberRelation()->setId(2);
        $source->getLaw()->setId(3);
        $this->requestedEntityService->method('getEntity')->willReturn($source);
        $result = $this->entityDomService->getDomDocument();
        $expectedAttributNames = [
            SlugAttributInterface::SLUG_ATTRIBUT_NAME,
            IdAttributInterface::ID_ATTRIBUT_NAME,
            VersionAttributInterface::VERSION_ATTRIBUT_NAME,
            LayerType::getReadableValue(LayerType::MEMBER),
            LayerType::getReadableValue(LayerType::LAW),
//             LayerType::getReadableValue(LayerType::HEREDITY),
            LayerType::getReadableValue(LayerType::CREATOR),
        ];
        $this->assertEquals(count($expectedAttributNames), count($result->childNodes));
        foreach ($result->childNodes as $attribut) {
            $name = $attribut->getAttribute('name');
            $layer = $attribut->getAttribute('layer');
            $id = $attribut->getAttribute('id');
            $this->assertTrue(in_array($name, $expectedAttributNames), "The attribut name <<$name>> is not defined in the expected values!");
            if (in_array($layer, LayerType::getValues())) {
                $this->assertGreaterThan(0, $id);
            }
        }
    }
}
