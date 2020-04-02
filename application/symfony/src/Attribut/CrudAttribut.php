<?php

namespace Infinito\Attribut;

use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Exception\Type\InvalidChoiceTypeException;

/**
 * @author kevinfrantz
 *
 * @see CrudAttributInterface
 */
trait CrudAttribut
{
    /**
     * @see CRUDType
     *
     * @var string
     */
    protected $crud;

    public function setCrud(string $crud): void
    {
        if (!in_array($crud, CRUDType::getValues())) {
            throw new InvalidChoiceTypeException("Value <<$crud>> is no valid choice!");
        }
        $this->crud = $crud;
    }

    public function getCrud(): string
    {
        return $this->crud;
    }
}
