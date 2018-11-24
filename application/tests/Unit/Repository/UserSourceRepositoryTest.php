<?php

namespace tests\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Entity\Source\Complex\UserSource;

/**
 * @todo refactor this to an integration test!
 *
 * @author kevinfrantz
 */
class UserSourceRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testAddAndRemoveMember(): void
    {
        $insertSource = new UserSource();
        $origineSource = new UserSource();
        $origineSource->addMember($insertSource);
        $this->entityManager->persist($insertSource);
        $this->entityManager->persist($origineSource);
        $this->entityManager->flush();
        $this->assertGreaterThan(0, $insertSource->getId());
        $this->assertGreaterThan(0, $origineSource->getId());
        $this->assertEquals($insertSource, $origineSource->getMembers()
            ->get(0));
        $this->assertEquals($origineSource, $insertSource->getMemberships()
            ->get(0));
        $this->assertNull($origineSource->removeMember($insertSource));
        $this->assertEquals(0, $origineSource->getMembers()
            ->count());
        $this->assertEquals(0, $insertSource->getMemberships()
            ->count());
        $this->entityManager->remove($origineSource);
        $this->entityManager->flush();
        $this->assertGreaterThan(0, $insertSource->getId());
        $this->entityManager->remove($insertSource);
        $this->entityManager->flush();
        $this->expectException(\TypeError::class);
        $insertSource->getId();
    }

    public function testCreation(): void
    {
        $userSource = new UserSource();
        $this->entityManager->persist($userSource);
        $this->entityManager->flush();
        $userSourceId = $userSource->getId();
        $loadedUserSource = $this->entityManager->getRepository(UserSource::class)->find($userSourceId);
        $this->assertEquals($userSourceId, $loadedUserSource->getId());
        $this->entityManager->remove($loadedUserSource);
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
