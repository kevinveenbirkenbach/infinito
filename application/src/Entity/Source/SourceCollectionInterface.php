<?php
namespace App\Entity\Source;

use App\Entity\Source\Attribut\SourceMembersAttributInterface;
use Doctrine\Common\Collections\Collection;

/**
 * Allows to handle SourceCollections like normal collections.
 * This interface also specifies the parameters of the collection interface via PHPDoc
 *
 * @author kevinfrantz
 * @todo Map the not jet mapped functions!
 *      
 */
interface SourceCollectionInterface extends SourceMembersAttributInterface, Collection
{

    /**
     *
     * @param SourceInterface $element
     * @return bool
     */
    public function add($element);

    /**
     *
     * @param SourceInterface $element
     * @return bool
     */
    public function contains($element);

    /**
     *
     * @param SourceInterface $element
     * @return bool
     */
    public function removeElement($element);

    /**
     *
     * @param string|int $key
     * @return SourceInterface|null
     */
    public function get($key);

    /**
     *
     * @return array|SourceInterface[]
     */
    public function getValues();

    /**
     *
     * @param string|int $key
     * @param SourceInterface $value
     * @return void
     */
    public function set($key, $value);

    /**
     *
     * @return array|SourceInterface[]
     */
    public function toArray();

    /**
     *
     * @return SourceInterface
     */
    public function first();

    /**
     *
     * @return SourceInterface
     */
    public function last();

    /**
     *
     * @return SourceInterface
     */
    public function current();

    /**
     *
     * @return SourceInterface
     */
    public function next();

    /**
     *
     * @param SourceInterface $element
     *
     * @return int|string|bool
     */
    public function indexOf($element);

    /**
     *
     * @param int $offset
     * @param int|null $length
     *
     * @return array|SourceInterface[]
     */
    public function slice($offset, $length = null);
}

