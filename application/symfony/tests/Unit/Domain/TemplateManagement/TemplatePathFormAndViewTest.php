<?php

namespace tests\Unit\Domain\TemplateManagement;

use PHPUnit\Framework\TestCase;
use App\Domain\TemplateManagement\TemplatePathFormAndView;
use App\DBAL\Types\RESTResponseType;

/**
 * @author kevinfrantz
 */
class TemplatePathFormAndViewTest extends TestCase
{
    const FILE = 'hello_world';

    const FOLDER = 'folder';

    const BASE_PATH = 'atom/view/'.self::FOLDER.'/'.self::FILE.'.';

    /**
     * @var TemplatePathFormAndView
     */
    private $templatePathFormAndView;

    public function setUp()
    {
        $this->templatePathFormAndView = new TemplatePathFormAndView(self::FILE, self::FOLDER);
    }

    public function testTypeReload(): void
    {
        foreach (RESTResponseType::getChoices() as $type) {
            $this->templatePathFormAndView->reloadType($type);
            $this->assertEquals(self::BASE_PATH.$type.'.twig', $this->templatePathFormAndView->getView()->getAtomTemplatePath());
        }
    }
}