<?php

namespace App\Domain\RequestManagement\Entity;

use App\Entity\AbstractEntity;
use App\Entity\EntityInterface;
use App\Attribut\SlugAttribut;
use Doctrine\ORM\EntityManagerInterface;
use App\Attribut\RequestedRightAttribut;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use App\Repository\Source\SourceRepositoryInterface;
use App\Exception\NotCorrectInstanceException;
use App\Entity\Source\AbstractSource;
use App\Exception\NotSetException;
use App\Repository\RepositoryInterface;
use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
class RequestedEntity extends AbstractEntity implements RequestedEntityInterface
{
    use SlugAttribut, RequestedRightAttribut;

    /**
     * @var LayerRepositoryFactoryServiceInterface
     */
    private $layerRepositoryFactoryService;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService)
    {
        $this->layerRepositoryFactoryService = $layerRepositoryFactoryService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\Entity\RequestedEntityInterface::setIdentity()
     */
    public function setIdentity($identity): void
    {
        if (is_numeric($identity)) {
            $this->setId($identity);
            $this->slug = null;

            return;
        }
        $this->setSlug($identity);
        $this->id = null;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\Entity\RequestedEntityInterface::getEntity()
     */
    public function getEntity(): EntityInterface
    {
        if ($this->hasSlug()) {
            return $this->loadBySlug();
        }
        if ($this->hasId()) {
            return $this->loadById();
        }
        throw new NotSetException('No identity attribut like id or slug was set!');
    }

    /**
     * @return RepositoryInterface
     */
    private function getEntityRepository(): RepositoryInterface
    {
        $layer = $this->requestedRight->getLayer();
        $repository = $this->layerRepositoryFactoryService->getRepository($layer);

        return $repository;
    }

    /**
     * @throws NotCorrectInstanceException
     *
     * @return SourceInterface
     */
    private function loadBySlug(): SourceInterface
    {
        $repository = $this->getEntityRepository();
        if ($repository instanceof SourceRepositoryInterface) {
            return $repository->findOneBySlug($this->slug);
        }
        throw new NotCorrectInstanceException('To read an entity by slug is just allowed for entitys of type '.AbstractSource::class);
    }

    /**
     * @return EntityInterface
     */
    private function loadById(): EntityInterface
    {
        $repository = $this->getEntityRepository();

        return $repository->find($this->id);
    }
}
