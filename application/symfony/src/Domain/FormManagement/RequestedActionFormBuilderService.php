<?php

namespace App\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * @author kevinfrantz
 */
final class RequestedActionFormBuilderService extends RequestedActionFormBuilder implements RequestedActionFormBuilderServiceInterface
{
    /**
     * @var RequestedActionServiceInterface
     */
    private $requestedActionService;

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\FormManagement\RequestedActionFormBuilder::__construct()
     */
    public function __construct(FormFactoryInterface $formFactory, FormClassNameServiceInterface $formClassNameService, RequestedActionServiceInterface $requestedActionService)
    {
        parent::__construct($formFactory, $formClassNameService);
        $this->requestedActionService = $requestedActionService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\FormManagement\RequestedActionFormBuilderServiceInterface::createByRequestedActionService()
     */
    public function createByService(): FormBuilderInterface
    {
        return parent::create($this->requestedActionService);
    }
}
