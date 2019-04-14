<?php

namespace tests\Integration\Domain\ActionManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\Domain\ActionManagement\ActionDAOServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author kevinfrantz
 */
class ActionServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var ActionDAOServiceInterface
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
        $this->actionService = self::$container->get(ActionDAOServiceInterface::class);
    }

    public function testEntityManager(): void
    {
        $this->assertInstanceOf(EntityManagerInterface::class, $this->actionService->getEntityManager());
    }
}
