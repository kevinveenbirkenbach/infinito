<?php

namespace Infinito\Domain\MVCManagement;

use FOS\RestBundle\View\View;
use Infinito\Domain\ActionManagement\ActionHandlerServiceInterface;
use Infinito\Domain\TemplateManagement\TemplateNameServiceInterface;
use Infinito\Domain\TemplateManagement\ActionTemplateDataStoreServiceInterface;
use Infinito\Attribut\ActionTypeAttribut;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;

/**
 * @author kevinfrantz
 *
 * @todo Refactor this class
 * @todo Test this class
 */
final class MVCRoutineService implements MVCRoutineServiceInterface
{
    use ActionTypeAttribut;

    /**
     * @var string The path to the general entity template
     */
    const TWIG_ENTITY_TEMPLATE_PATH = 'entity/entity.html.twig';

    /**
     * @var ActionHandlerServiceInterface
     */
    private $actionHandlerService;

    /**
     * @var TemplateNameServiceInterface
     */
    private $templateNameService;

    /**
     * @var ActionTemplateDataStoreServiceInterface
     */
    private $actionTemplateDataStore;

    /**
     * @var RequestedActionFormBuilderServiceInterface
     */
    private $requestedActionFormBuilderService;

    /**
     * @var RequestedActionServiceInterface
     */
    private $requestedActionService;

    /**
     * @var SecureRequestedRightCheckerServiceInterface
     */
    private $secureRequestedRightCheckerService;

    /**
     * @return View
     */
    private function getView(): View
    {
        $view = View::create();
        $view->setTemplate(self::TWIG_ENTITY_TEMPLATE_PATH);

        return $view;
    }

    /**
     * @param ActionHandlerServiceInterface $actionHandlerService
     */
    public function __construct(ActionHandlerServiceInterface $actionHandlerService, TemplateNameServiceInterface $templateNameService, ActionTemplateDataStoreServiceInterface $actionTemplateDataStore, RequestedActionFormBuilderServiceInterface $requestedActionFormBuilderService, RequestedActionServiceInterface $requestedActionService, SecureRequestedRightCheckerServiceInterface $secureRequestedRightCheckerService)
    {
        $this->actionHandlerService = $actionHandlerService;
        $this->templateNameService = $templateNameService;
        $this->actionTemplateDataStore = $actionTemplateDataStore;
        $this->requestedActionFormBuilderService = $requestedActionFormBuilderService;
        $this->requestedActionService = $requestedActionService;
        $this->secureRequestedRightCheckerService = $secureRequestedRightCheckerService;
    }

    /**
     * @todo Optimize the whole following function. It's just implemented like this for test reasons.
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\MVCManagement\MVCRoutineServiceInterface::process()
     */
    public function process(): View
    {
        if (!$this->actionType) {
            if ($this->requestedActionService->hasRequestedEntity() && $this->requestedActionService->getRequestedEntity()->hasIdentity()) {
                //READ VIEW
//                 $this->requestedActionService->setActionType(ActionType::READ);
                if ($this->secureRequestedRightCheckerService->check($this->requestedActionService)) {
                    $read = $this->actionHandlerService->handle();
                    $this->actionTemplateDataStore->setData(ActionType::READ, $read);
                }
//                 $this->requestedActionService->setActionType(ActionType::UPDATE);
                //UPDATE VIEW
//                 if ($this->secureRequestedRightCheckerService->check($this->requestedActionService)) {
//                     $updateForm = $this->requestedActionFormBuilderService->createByService()->getForm()->createView();
//                     $this->actionTemplateDataStore->setData(ActionType::UPDATE, $updateForm);
//                 }
                //DELETE VIEW
                //EXECUTE VIEW
            } else {
                //CREATE
                $this->requestedActionService->getRequestedEntity()->setClass(TextSource::class);
                $updateForm = $this->requestedActionFormBuilderService->createByService()->getForm()->createView();
                $this->actionTemplateDataStore->setData(ActionType::CREATE, $updateForm);
            }

            return $this->getView();
        }
        throw new \Exception('Not implemented yet!');
    }
}
