<?php

namespace tests\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\UserInterface;

class UserRepositoryTest extends KernelTestCase
{
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

    /**
     * @todo Test double username
     * @todo Test double email
     */
    public function testCreation(): void
    {
        $user = new User();
        $user->setUsername('Karl Marx');
        $user->setEmail('mew21@test.de');
        $user->setPassword('Friedrich ist kein Engel!:)');
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $userId = $user->getId();
        /**
         * @var UserInterface
         */
        $loadedUser = $this->userRepository->find($userId);
        $this->assertEquals($userId, $loadedUser->getId());
        $this->entityManager->remove($loadedUser);
        $this->entityManager->flush();
        $this->assertNull($this->userRepository->find($userId));
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
