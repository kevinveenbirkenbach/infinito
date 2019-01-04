<?php

namespace App\Repository\Source;

use Doctrine\ORM\EntityRepository;
use App\Entity\Source\SourceInterface;

final class SourceRepository extends EntityRepository
{
    /**
     * @param string $slug
     *
     * @return SourceInterface|null
     */
    public function findOneBySlug(string $slug): ?SourceInterface
    {
        return $this->findOneBy(['slug' => $slug]);
    }
}
