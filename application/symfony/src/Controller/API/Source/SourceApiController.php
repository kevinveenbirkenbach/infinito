<?php

namespace App\Controller\API\Source;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\API\AbstractAPIController;
use App\Entity\Source\PureSource;
use App\Domain\SecureCRUDManagement\SecureCRUDFactoryService;
use App\Domain\SecureCRUDManagement\Create\SecureSourceCreatorInterface;

/**
 * @author kevinfrantz
 * @todo Implement!
 */
class SourceApiController extends AbstractAPIController
{
    /**
     * @Route("/{_locale}/api/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"GET"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\AbstractAPIController::read()
     */
    public function read(Request $request, $identifier): Response
    {
    }

    /**
     * @Route("/{_locale}/api/source.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"POST","GET"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\AbstractAPIController::create()
     */
    public function create(Request $request, SecureCRUDFactoryService $crudFactory): Response
    {
        $response = new Response();
        if (!$this->getUser()) {
            //throw $this->createAccessDeniedException('The user must be logged in!');
        }

        if (Request::METHOD_POST === $request->getMethod()) {
            $response = new Response();
            $response->setContent('Post Request!');

            return $response;
        }
        /**
         * @var SecureSourceCreatorInterface
         */
        $sourceCreator = $crudFactory->create();
        $response->setContent($sourceCreator->create()->getText());

        return $response;

//         $response = new Response();
//         $response->setContent('GET Request!');

//         return $response;

//         $requestedSource = new PureSource();
//         $requestedSource->setSlug(SystemSlugType::IMPRINT);
//         $requestedRight = new Right();
//         $requestedRight->setSource($requestedSource);
//         $requestedRight->setLayer(LayerType::SOURCE);
//         $requestedRight->setType(CRUDType::READ);
//         $sourceResponseManager = new SourceRESTResponseManager($this->getUser(), $entityManager, $requestedRight, $this->getViewHandler());

//         return $sourceResponseManager->getResponse();
    }

    /**
     * @Route("/{_locale}/api/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"PUT"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\AbstractAPIController::update()
     */
    public function update(Request $request, $identifier): Response
    {
    }

    /**
     * @Route("/{_locale}/api/sources/.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"GET"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\AbstractAPIController::list()
     */
    public function list(Request $request): Response
    {
    }

    /**
     * @Route("/{_locale}/api/source/{identifier}.{_format}",
     * defaults={"_format"="json"} ,
     * methods={"DELETE"}
     * )
     * {@inheritdoc}
     *
     * @see \App\Controller\API\AbstractAPIController::delete()
     */
    public function delete(Request $request, $identifier): Response
    {
    }
}
