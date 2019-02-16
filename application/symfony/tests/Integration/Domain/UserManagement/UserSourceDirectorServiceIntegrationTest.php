<?php

namespace tests\Integration\Domain\UserManagement;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\UserManagement\UserSourceDirectorServiceInterface;
use App\Entity\UserInterface;

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
