<?php
namespace App\Entity\Source;

use App\Entity\Source\Attribut\SourceMembersAttribut;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Closure;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="source_collection")
 * @ORM\Entity     
 */
class SourceCollection extends AbstractSource implements SourceCollectionInterface
{
    use SourceMembersAttribut;

    /**
     *
     * @var Collection
     * @ORM\ManyToMany(targetEntity="AbstractSource")
     */
    protected $members;
    
    public function next()
    {
        return $this->members->next();
    }

    public function forAll(Closure $p)
    {
        return $this->members->forAll($p);
    }

    public function remove($key)
    {
        return $this->members->remove($key);
    }

    public function current()
    {
        return $this->members->current();
    }

    public function partition(Closure $p)
    {
        return $this->members->partition($p);
    }

    public function offsetExists($offset)
    {
        return $this->offsetExists($offset);
    }

    public function slice($offset, $length = null)
    {
        return $this->slice($offset, $length);
    }

    public function get($key)
    {
        return $this->members->get($key);
    }

    public function offsetUnset($offset)
    {
        return $this->members->offsetUnset($offset);
    }

    public function toArray()
    {
        return $this->members->toArray();
    }

    public function map(Closure $func)
    {
        return $this->members->map($func);
    }

    public function indexOf($element)
    {
        return $this->members->indexOf($element);
    }

    public function key()
    {
        return $this->members->key();
    }

    public function add($element)
    {
        return $this->add($element);
    }

    public function offsetGet($offset)
    {
        return $this->members->offsetGet($offset);
    }

    public function set($key, $value)
    {
        return $this->members->set($key, $value);
    }

    public function getValues()
    {
        return $this->members->getValues();
    }

    public function last()
    {
        return $this->members->last();
    }

    public function containsKey($key)
    {
        return $this->members->containsKey($key);
    }

    public function clear()
    {
        return $this->members->clear();
    }

    public function isEmpty()
    {
        return $this->members->isEmpty();
    }

    public function count()
    {
        return $this->members->count();
    }

    public function getKeys()
    {
        return $this->members->getKeys();
    }

    public function offsetSet($offset, $value)
    {
        return $this->members->offsetSet($offset, $value);
    }

    public function filter(Closure $p)
    {
        return $this->members->filter($p);
    }

    public function contains($element)
    {
        return $this->members->contains($element);
    }

    public function getIterator()
    {
        return $this->members->getIterator();
    }

    public function exists(Closure $p)
    {
        return $this->members->exists($p);
    }

    public function removeElement($element)
    {
        return $this->members->removeElement($element);
    }

    public function first()
    {
        return $this->members->first();
    }
}

