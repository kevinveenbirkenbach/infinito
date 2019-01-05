<?php

namespace Unit\Domain\ResponseManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Meta\RightInterface;
use App\Entity\Meta\Right;
use FOS\RestBundle\View\ViewHandlerInterface;
use App\Entity\Source\PureSource;
use App\DBAL\Types\SystemSlugType;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Domain\ResponseManagement\SourceRESTResponseManager;
use App\Exception\AllreadyDefinedException;

/**
 * @author kevinfrantz
 *
 * @todo Implement more tests!
 */
class SourceRESTReponseManagerTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RightInterface
     */
    private $requestedRight;

    /**
     * @var ViewHandlerInterface
     */
    private $viewHandler;

    private function setRequestedRight(): void
    {
        $this->requestedRight = new Right();
    }

    private function setEntityManager(): void
    {
        $this->entityManager = self::$container->get('doctrine.orm.default_entity_manager');
    }

    private function setViewHandler(): void
    {
        $this->viewHandler = $this->createMock(ViewHandlerInterface::class);
    }

    public function setUp(): void
    {
        self::bootKernel();
        $this->setEntityManager();
        $this->setRequestedRight();
        $this->setViewHandler();
    }

    public function testAllreadyDefinedException(): void
    {
        $requestedSource = new PureSource();
        $requestedSource->setSlug(SystemSlugType::IMPRINT);
        $requestedRight = new Right();
        $requestedRight->setSource($requestedSource);
        $requestedRight->setReciever(new PureSource());
        $requestedRight->setLayer(LayerType::SOURCE);
        $requestedRight->setType(CRUDType::READ);
        $this->expectException(AllreadyDefinedException::class);
        $sourceResponseManager = new SourceRESTResponseManager(null, $this->entityManager, $requestedRight, $this->viewHandler);
        $sourceResponseManager->getResponse();
    }
}
