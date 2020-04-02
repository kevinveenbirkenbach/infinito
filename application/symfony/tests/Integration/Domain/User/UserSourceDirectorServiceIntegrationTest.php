<?php

namespace tests\Integration\Domain\User;

use Infinito\Domain\User\UserSourceDirectorServiceInterface;
use Infinito\Entity\UserInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author kevinfrantz
 */
class UserSourceDirectorServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var UserSourceDirectorServiceInterface
     */
    private $userSourceDirectorService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
        $this->userSourceDirectorService = self::$container->get(UserSourceDirectorServiceInterface::class);
    }

    public function testCrudAccessors(): void
    {
        $this->assertInstanceOf(UserInterface::class, $this->userSourceDirectorService->getUser());
    }
}
