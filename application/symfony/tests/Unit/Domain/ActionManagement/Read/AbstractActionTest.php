<?php

namespace tests\Unit\Domain\ActionManagement\Read;

use PHPUnit\Framework\TestCase;
use App\Domain\ActionManagement\ActionInterface;
use App\Domain\ActionManagement\AbstractAction;
use App\Domain\ActionManagement\ActionServiceInterface;
use PHPUnit\Framework\MockObject\MockObject;
use App\Exception\NotValidByFormException;

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
     * @var ActionServiceInterface|MockObject
     */
    private $actionService;

    public function setUp(): void
    {
        $this->actionService = $this->createMock(ActionServiceInterface::class);
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
        $this->expectException(NotValidByFormException::class);
        $this->action->execute();
    }
}
