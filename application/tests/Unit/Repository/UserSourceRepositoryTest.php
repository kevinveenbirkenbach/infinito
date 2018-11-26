<?php

namespace tests\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Entity\Source\Complex\UserSource;
use App\Domain\SourceManagement\SourceMemberManager;

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
        $origineSourceMemberManager = new SourceMemberManager($origineSource);
        $origineSourceMemberManager->addMember($insertSource);
        $this->entityManager->persist($insertSource);
        $this->entityManager->persist($origineSource);
        $this->entityManager->flush();
        $this->assertGreaterThan(0, $insertSource->getId());
        $this->assertGreaterThan(0, $origineSource->getId());
        $this->assertEquals($insertSource, $origineSource->getMemberRelation()->getMembers()
            ->get(0)->getSource());
        $this->assertEquals($origineSource, $insertSource->getMemberRelation()->getMemberships()
            ->get(0)->getSource());
        $this->assertNull($origineSourceMemberManager->removeMember($insertSource));
        $this->assertEquals(0, $origineSource->getMemberRelation()->getMembers()
            ->count());
        $this->assertEquals(0, $insertSource->getMemberRelation()->getMemberships()
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
        $this->assertGreaterThan(0, $userSource->getCreatorRelation()->getId());
        $this->assertGreaterThan(0, $userSource->getLaw()->getId());
        $this->assertFalse($userSource->hasPersonIdentitySource());
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
