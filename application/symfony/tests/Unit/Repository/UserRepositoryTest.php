<?php

namespace tests\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use Infinito\Repository\UserRepository;
use Infinito\Entity\User;
use Infinito\Entity\UserInterface;
use Infinito\Entity\Source\Complex\PersonIdentitySourceInterface;
use Infinito\Entity\Source\Complex\PersonIdentitySource;

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

    /**
     * @var UserInterface
     */
    protected $loadedUser;

    /**
     * @var UserInterface
     */
    protected $user;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
        $this->user = new User();
        $this->user->setUsername('Karl Marx');
        $this->user->setEmail('mew21@test.de');
        $this->user->setPassword('Die Philosophen haben die Welt nur verschieden interpretiert; es kommt aber darauf an, sie zu verändern.');
    }

    /**
     * @todo Test double username
     * @todo Test double email
     */
    public function testCreation(): void
    {
        $this->entityManager->persist($this->user);
        $this->entityManager->flush();
        $userId = $this->user->getId();
        /*
         * @var UserInterface
         */
        $this->loadedUser = $this->userRepository->find($userId);
        $this->assertEquals($userId, $this->loadedUser->getId());
        $this->assertGreaterThan(0, $this->loadedUser->getSource()->getId());
        $this->deleteUser();
        $this->assertNull($this->userRepository->find($userId));
        $this->loadedUser = null;
    }

    public function testUserWithPersonIdentitySource(): void
    {
        /**
         * @var PersonIdentitySourceInterface
         */
        $personIdentity = new PersonIdentitySource();
        $personIdentity->getFullPersonNameSource()->getFirstNameSource()->setName('Karl');
        $personIdentity->getFullPersonNameSource()->getSurnameSource()->setName('Marx');
        $this->user->getSource()->setPersonIdentitySource($personIdentity);
        $this->entityManager->persist($this->user);
        $this->entityManager->flush();
        $userId = $this->user->getId();
        $this->loadedUser = $this->userRepository->find($userId);
        $this->assertGreaterThan(0, $this->loadedUser->getSource()->getPersonIdentitySource()->getId());
        $this->assertGreaterThan(0, $this->loadedUser->getSource()->getPersonIdentitySource()->getFullPersonNameSource()->getId());
        $this->assertGreaterThan(0, $this->loadedUser->getSource()->getPersonIdentitySource()->getFullPersonNameSource()->getFirstNameSource()->getId());
        $this->assertGreaterThan(0, $this->loadedUser->getSource()->getPersonIdentitySource()->getFullPersonNameSource()->getSurnameSource()->getId());
        $this->deleteUser();
    }

    private function deleteUser(): void
    {
        $this->entityManager->remove($this->loadedUser);
        $this->entityManager->flush();
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
