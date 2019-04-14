<?php

namespace tests\Unit\Domain\ActionManagement\Read;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\ActionManagement\ActionInterface;
use Infinito\Domain\ActionManagement\AbstractAction;
use Infinito\Domain\ActionManagement\ActionDependenciesDAOServiceInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Infinito\Exception\Validation\FormInvalidException;

/**
 * @author kevinfrantz
 */
class AbstractActionTest extends TestCase
{
    /**
     * @var ActionInterface
     */
    private $action;

    /**
     * @var ActionDependenciesDAOServiceInterface|MockObject
     */
    private $actionService;

    public function setUp(): void
    {
        $this->actionService = $this->createMock(ActionDependenciesDAOServiceInterface::class);
        $this->action = new class($this->actionService) extends AbstractAction {
            public $isSecure;
            public $validByForm;

            protected function isSecure(): bool
            {
                return $this->isSecure;
            }

            protected function isValid(): bool
            {
                return $this->validByForm;
            }

            protected function proccess()
            {
            }
        };
    }

    public function testNotValidByFormException(): void
    {
        $this->action->isSecure = true;
        $this->action->validByForm = false;
        $this->expectException(FormInvalidException::class);
        $this->action->execute();
    }
}
