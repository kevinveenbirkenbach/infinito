<?php
namespace Infinito\Attribut;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 *
 * @see ClassAttributInterface
 *
 * @author kevinfrantz
 */
trait ClassAttribut
{

    /**
     *
     * @var string
     */
    private $class;

    /**
     *
     * @param string $class
     */
    public function setClass(string $class): void
    {
        if (class_exists($class)) {
            $this->class = $class;

            return;
        }
        throw new NotFoundHttpException('Class ' . $class . ' couldn\'t be found!');
    }

    /**
     *
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     *
     * @return bool
     */
    public function hasClass(): bool
    {
        return isset($this->class);
    }
}
