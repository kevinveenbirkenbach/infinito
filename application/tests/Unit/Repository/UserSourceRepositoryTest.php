<?php
namespace tests\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Entity\UserInterface;
use App\Repository\UserSourceRepository;
use App\Entity\Source\Complex\UserSourceInterface;
use App\Entity\Source\Complex\UserSource;

class UserSourceRepositoryTest extends KernelTestCase
{

    /**
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     *
     * @var UserSourceRepository
     */
    protected $userSourceRepository;

    /**
     *
     * @var UserSourceInterface
     */
    protected $loadedUserSource;

    /**
     *
     * @var UserInterface
     */
    protected $user;

    /**
     *
     * @var UserSourceInterface
     */
    protected $userSource;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $this->userSourceRepository = $this->entityManager->getRepository(UserSource::class);
        $this->userSource = new UserSource();
    }

    public function testMemberships(): void
    {
        $userSource2 = new UserSource();
        $this->userSource->getMemberships()->add($userSource2);
        $this->entityManager->persist($this->userSource);
        $this->entityManager->flush();
        $userSource2Id = $userSource2->getId();
        $userSourceId = $this->userSource->getId();
        $this->loadedUserSource = $this->userSourceRepository->find($userSourceId);
        $this->assertGreaterThan(0, $userSource2Id);
        $this->assertEquals($userSource2, $this->loadedUserSource->getMemberships()->get(0));
        $this->deleteUserSource();
        $this->assertGreaterThan(0, $userSource2Id);
        $this->entityManager->remove($userSource2);
        $this->entityManager->flush();
        $this->assertNull($this->userSourceRepository->find($userSource2Id));
    }

    public function testCreation(): void
    {
        $this->entityManager->persist($this->userSource);
        $this->entityManager->flush();
        $userSourceId = $this->userSource->getId();
        /*
         * @var UserSourceInterface
         */
        $this->loadedUserSource = $this->userSourceRepository->find($userSourceId);
        $this->assertEquals($userSourceId, $this->loadedUserSource->getId());
        $this->deleteUserSource();
    }

    private function deleteUserSource(): void
    {
        $this->entityManager->remove($this->loadedUserSource);
        $this->entityManager->flush();
    }

    /**
     *
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
