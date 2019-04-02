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
use Infinito\Entity\Meta\Law;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Meta\RightInterface;
use Infinito\Attribut\SourceAttributInterface;
use Infinito\Attribut\GrantAttributInterface;
use Infinito\Attribut\RightsAttributInterface;
use Infinito\Entity\EntityInterface;
use Infinito\Attribut\VersionAttribut;
use Infinito\Attribut\IdAttribut;
use Infinito\Exception\NotCorrectInstanceException;
use Infinito\Entity\Source\Complex\UserSource;
use Infinito\Entity\User;
use Infinito\Attribut\UserAttributInterface;

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

    public function testNotCorrectInstanceException(): void
    {
        $entity = new class() implements EntityInterface {
            use VersionAttribut,IdAttribut;
            private $test;

            public function setTest($test): void
            {
                $this->test = $test;
            }

            public function getTest()
            {
                return $this->test;
            }
        };
        $entity->setTest(new class() {
        });
        $this->requestedEntityService->method('getEntity')->willReturn($entity);
        $this->expectException(NotCorrectInstanceException::class);
        $this->entityDomService->getDomDocument();
    }

    public function testUserSource(): void
    {
        $userSource = new UserSource();
        $userId = 1234;
        $user = new User();
        $user->setId($userId);
        $userSource->setUser($user);
        $this->requestedEntityService->method('getEntity')->willReturn($userSource);
        $result = $this->entityDomService->getDomDocument();
        foreach ($result->childNodes as $attribut) {
            $name = $attribut->getAttribute('name');
            $value = $attribut->getAttribute('value');
            if (UserAttributInterface::USER_ATTRIBUT_NAME === $name) {
                $this->assertEquals($userId, $value);

                return;
            }
        }
        $this->assertTrue(false, 'The user attribut was not defined!');
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

    public function testLaw(): void
    {
        $source = $this->createMock(SourceInterface::class);
        $source->method('getId')->willReturn(123);
        $source->method('hasId')->willReturn(true);
        $right = $this->createMock(RightInterface::class);
        $right->method('getId')->willReturn(124);
        $right->method('hasId')->willReturn(true);
        $id = 12345;
        $law = new Law();
        $law->setId($id);
        $law->setSource($source);
        $law->getRights()->add($right);
        $law->getRights()->add(clone $right);
        $law->getRights()->add(clone $right);
        $this->requestedEntityService->method('getEntity')->willReturn($law);
        $result = $this->entityDomService->getDomDocument();
        foreach ($result->childNodes as $attribut) {
            $name = $attribut->getAttribute('name');
            $value = $attribut->getAttribute('value');
            $id = $attribut->getAttribute('id');
            $layer = $attribut->getAttribute('layer');
            $type = $attribut->getAttribute('type');
            switch ($name) {
                case IdAttributInterface::ID_ATTRIBUT_NAME:
                    $this->assertGreaterThan(0, $value);
                    break;
                case VersionAttributInterface::VERSION_ATTRIBUT_NAME:
                    $this->assertGreaterThan(-1, $value);
                    break;
                case SourceAttributInterface::SOURCE_ATTRIBUT_NAME:
                    $this->assertGreaterThan(0, $id);
                    $this->assertEquals(LayerType::SOURCE, $layer);
                    break;
                case GrantAttributInterface::GRANT_ATTRIBUT_NAME:
                    $this->assertEquals('', $value);
                    $this->assertEquals('boolean', $type);
                    break;
                case RightsAttributInterface::RIGHTS_ATTRIBUT_NAME:
                    $rights = $attribut->childNodes;
                    $this->assertCount(3, $rights);
                    foreach ($rights as $rightAttribut) {
                        $this->assertEquals(LayerType::RIGHT, $rightAttribut->getAttribute('layer'));
                        $this->assertGreaterThan(0, $rightAttribut->getAttribute('id'));
                    }
                    break;
                default:
                    throw new \Exception("No assert was defined for attribut with name <<$name>>!");
            }
        }
    }
}
