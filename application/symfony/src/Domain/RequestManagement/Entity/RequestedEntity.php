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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Attribut\ClassAttribut;
use App\Exception\AllreadyDefinedException;
use App\Domain\RequestManagement\Right\RequestedRightInterface;

/**
 * @author kevinfrantz
 */
class RequestedEntity extends AbstractEntity implements RequestedEntityInterface
{
    use SlugAttribut,
    RequestedRightAttribut,
    ClassAttribut{ setClass as private setClassTrait; getClass as private getClassTrait; }

    /**
     * @var LayerRepositoryFactoryServiceInterface
     */
    private $layerRepositoryFactoryService;

    /**
     * @throws NotSetException
     */
    private function validateHasIdentity(): void
    {
        if (!($this->hasId() || $this->hasSlug())) {
            throw new NotSetException('No identity attribut like id or slug was set!');
        }
    }

    /**
     * @param EntityInterface|null $entity
     *
     * @throws NotFoundHttpException
     */
    private function validateLoadedEntity(?EntityInterface $entity): void
    {
        if (!$entity) {
            throw new NotFoundHttpException('Entity with {id:"'.$this->id.'",slug:"'.$this->slug.'"} not found');
        }
    }

    /**
     * @return EntityInterface|SourceInterface|null
     */
    private function loadEntityBySlugOrId(): ?EntityInterface
    {
        if ($this->hasSlug()) {
            return $this->loadBySlug();
        }

        return $this->loadById();
    }

    /**
     * @throws NotCorrectInstanceException
     *
     * @return SourceInterface|null
     */
    private function loadBySlug(): ?SourceInterface
    {
        $repository = $this->getEntityRepository();
        if ($repository instanceof SourceRepositoryInterface) {
            return $repository->findOneBySlug($this->slug);
        }
        throw new NotCorrectInstanceException('To read an entity by slug is just allowed for entitys of type '.AbstractSource::class);
    }

    /**
     * @return EntityInterface|null
     */
    private function loadById(): ?EntityInterface
    {
        $repository = $this->getEntityRepository();

        return $repository->find($this->id);
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
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(LayerRepositoryFactoryServiceInterface $layerRepositoryFactoryService)
    {
        $this->layerRepositoryFactoryService = $layerRepositoryFactoryService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\Entity\RequestedEntityInterface::hasIdentity()
     */
    public function hasIdentity(): bool
    {
        return $this->hasId() || $this->hasSlug();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\Entity\RequestedEntityInterface::setIdentity()
     */
    public function setIdentity($identity): void
    {
        if ($this->hasClass()) {
            throw new AllreadyDefinedException('A identity can\'t be set if a class is allready defined!');
        }
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
     * @see \App\Attribut\ClassAttributInterface::setClass()
     */
    public function setClass(string $class): void
    {
        if ($this->hasIdentity()) {
            throw new AllreadyDefinedException('A class can\'t be manual defined, if an identity is allready set!');
        }
        $this->setClassTrait($class);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\Entity\RequestedEntityInterface::getEntity()
     */
    public function getEntity(): EntityInterface
    {
        $this->validateHasIdentity();
        $entity = $this->loadEntityBySlugOrId();
        $this->validateLoadedEntity($entity);

        return $entity;
    }

    /**
     * Overriding is neccessary to declare the correct relation.
     *
     * {@inheritdoc}
     *
     * @see \App\Attribut\RequestedRightAttributInterface::setRequestedRight()
     */
    public function setRequestedRight(RequestedRightInterface $requestedRight): void
    {
        $this->requestedRight = $requestedRight;
        if (!$this->requestedRight->hasRequestedEntity()) {
            $this->requestedRight->setRequestedEntity($this);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\ClassAttributInterface::getClass()
     */
    public function getClass(): string
    {
        if ($this->hasClass()) {
            return $this->getClassTrait();
        }

        return get_class($this->getEntity());
    }
}
