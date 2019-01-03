<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\DBAL\Types\SystemSlugType;
use App\Entity\Source\AbstractSource;
use App\Entity\User;
use App\Domain\SecureLoadManagement\SecureSourceLoader;
use App\Entity\Meta\Right;
use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;

/**
 * This controller offers the standart routes for the template.
 *
 * @author kevinfrantz
 */
class DefaultController extends AbstractEntityController
{
    /**
     * @todo Optimize function!
     * @Route("/imprint", name="imprint")
     */
    public function imprint(): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser();
        } else {
            $user = new User();
            $user->setSource($this->getDoctrine()
                ->getRepository(AbstractSource::class)
                ->findOneBy(['slug' => SystemSlugType::GUEST_USER]));
        }
        $requestedSource = new class() extends AbstractSource {
        };
        $requestedSource->setSlug(SystemSlugType::IMPRINT);
        $requestedRight = new Right();
        $requestedRight->setSource($requestedSource);
        $requestedRight->setReciever($user->getSource());
        $requestedRight->setLayer(LayerType::SOURCE);
        $requestedRight->setType(RightType::READ);
        $secureSourceLoader = new SecureSourceLoader($this->getDoctrine()->getManager(), $requestedRight);
        $view = $this->view($secureSourceLoader->getSource(), 200)
        ->setTemplate('standard/imprint.html.twig')
        ->setTemplateVar('source');

        return $this->handleView($view);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return $this->render('standard/homepage.html.twig');
    }

    protected function setEntityName(): void
    {
        $this->entityName = AbstractSource::class;
    }
}
