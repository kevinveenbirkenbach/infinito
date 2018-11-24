<?php

namespace tests\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Entity\Meta\RightInterface;
use App\Entity\Meta\Right;
use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;
use App\Entity\Meta\Law;
use App\Entity\Meta\LawInterface;

/**
 * @todo specify tests for all attributes
 *
 * @author kevinfrantz
 */
class RightRepositoryTest extends KernelTestCase
{
    const PRIORITY = 123;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var EntityRepository
     */
    protected $rightRepository;

    /**
     * @var RightInterface
     */
    protected $loadedRight;

    /**
     * @var RightInterface
     */
    protected $right;

    /**
     * @var LawInterface
     */
    protected $law;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $this->rightRepository = $this->entityManager->getRepository(Right::class);
        $this->right = new Right();
        $this->right->setPriority(self::PRIORITY);
        $this->right->setLayer(LayerType::SOURCE);
        $this->right->setType(RightType::READ);
        $this->law = new Law();
        $this->entityManager->persist($this->law);
        $this->right->setLaw($this->law);
    }

    public function testCreation(): void
    {
        $this->entityManager->persist($this->right);
        $this->entityManager->flush();
        $rightId = $this->right->getId();
        /*
         * @var RightInterface
         */
        $this->loadedRight = $this->rightRepository->find($rightId);
        $this->assertEquals($rightId, $this->loadedRight->getId());
        $this->assertEquals(self::PRIORITY, $this->loadedRight->getPriority());
        $this->deleteRight();
        $this->assertNull($this->rightRepository->find($rightId));
        $this->loadedRight = null;
    }

    private function deleteRight(): void
    {
        $this->entityManager->remove($this->loadedRight);
        $this->entityManager->flush();
        $this->entityManager->remove($this->law);
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
