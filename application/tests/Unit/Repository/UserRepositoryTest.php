<?php

namespace tests\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\UserInterface;

class UserRepositoryTest extends KernelTestCase
{
    const USER_ID = 123456789;
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function testCreation(): void
    {
        $user = new User();
        $user->setId(self::USER_ID);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        /**
         * @var UserInterface
         */
        $loadedUser = $this->userRepository->find(self::USER_ID);
        $this->assertEquals(self::USER_ID, $loadedUser->getId());
    }

    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase::tearDown()
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
