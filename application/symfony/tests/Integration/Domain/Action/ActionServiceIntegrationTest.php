<?php

namespace tests\Integration\Domain\Action;

use Doctrine\ORM\EntityManagerInterface;
use Infinito\Domain\Action\ActionDependenciesDAOServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

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
