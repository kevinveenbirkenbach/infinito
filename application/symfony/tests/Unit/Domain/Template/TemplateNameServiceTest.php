<?php

namespace tests\Unit\Domain\Template;

use Infinito\Domain\Request\Action\RequestedActionServiceInterface;
use Infinito\Domain\Request\Entity\RequestedEntityServiceInterface;
use Infinito\Domain\Template\TemplateNameService;
use Infinito\Domain\Template\TemplateNameServiceInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class TemplateNameServiceTest extends TestCase
{
    /**
     * @var TemplateNameServiceInterface
     */
    private $templateNameService;

    /**
     * @var string
     */
    const CLASS_NAME = 'Infinito\\Entity\\Source\\PureSource';

    /**
     * @var string
     */
    const ACTION_TYPE = 'CREATE';

    /**
     * @var string
     */
    const EXPECTED_MOLECULE_TEMPLATE_NAME = 'entity/source/pure_source_create.html.twig';

    /**
     * @var string
     */
    const EXPECTED_ATOM_TEMPLATE_NAME = 'entity/source/_pure_source_create.html.twig';

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $requestedEntityService = $this->createMock(RequestedEntityServiceInterface::class);
        $requestedEntityService->method('getClass')->willReturn(self::CLASS_NAME);
        $requestedActionService = $this->createMock(RequestedActionServiceInterface::class);
        $requestedActionService->method('getRequestedEntity')->willReturn($requestedEntityService);
        $requestedActionService->method('getActionType')->willReturn(self::ACTION_TYPE);
        $this->templateNameService = new TemplateNameService($requestedActionService);
    }

    public function testGetMoleculeName(): void
    {
        $this->assertEquals(self::EXPECTED_MOLECULE_TEMPLATE_NAME, $this->templateNameService->getMoleculeTemplateName());
    }

    public function testGetAtomName(): void
    {
        $this->assertEquals(self::EXPECTED_ATOM_TEMPLATE_NAME, $this->templateNameService->getAtomTemplateName());
    }
}
