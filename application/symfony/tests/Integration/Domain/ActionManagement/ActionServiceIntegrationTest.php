<?php

namespace tests\Integration\Domain\ActionManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\Domain\ActionManagement\ActionDependenciesDAOServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author kevinfrantz
 */
class ActionServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var ActionDependenciesDAOServiceInterface
     */
    private $actionService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
        $this->actionService = self::$container->get(ActionDependenciesDAOServiceInterface::class);
    }

    public function testEntityManager(): void
    {
        $this->assertInstanceOf(EntityManagerInterface::class, $this->actionService->getEntityManager());
    }
}
