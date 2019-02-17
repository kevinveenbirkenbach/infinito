<?php

namespace tests\Integration\Domain\ActionManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\Domain\ActionManagement\ActionServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author kevinfrantz
 */
class ActionServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var ActionServiceInterface
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
        $this->actionService = self::$container->get(ActionServiceInterface::class);
    }

    public function testEnityManager(): void
    {
        $this->assertInstanceOf(EntityManagerInterface::class, $this->actionService->getEntityManager());
    }
}
