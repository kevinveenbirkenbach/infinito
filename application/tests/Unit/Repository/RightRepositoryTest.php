<?php

namespace tests\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityRepository;
use App\Entity\Meta\RightInterface;
use App\Entity\Meta\Right;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Entity\Meta\Law;
use App\Entity\Meta\LawInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @todo specify tests for all attributes
 *
 * @author kevinfrantz
 */
class RightRepositoryTest extends KernelTestCase
{
    const PRIORITY = 123;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var EntityRepository
     */
    private $rightRepository;

    /**
     * @var RightInterface
     */
    private $loadedRight;

    /**
     * @var RightInterface
     */
    private $right;

    /**
     * @var LawInterface
     */
    private $law;

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
        $this->right->setType(CRUDType::READ);
        $this->law = new Law();
        $this->entityManager->persist($this->law);
        $this->right->setLaw($this->law);
    }

    public function testCreation(): void
    {
        $this->entityManager->persist($this->right);
        $this->entityManager->flush();
        $rightId = $this->right->getId();
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
