<?php

namespace Infinito\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Infinito\Domain\FixtureManagement\FixtureSource\HomepageFixtureSource;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Infinito\DBAL\Types\RESTResponseType;

/**
 * This controller offers the standart routes for the template.
 *
 * @author kevinfrantz
 */
final class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
//         echo "Hello World!";
//         $url = $this->generateUrl('infinito_api_rest_layer_read', [
//             'identity' => HomepageFixtureSource::SLUG,
//             'layer' => LayerType::SOURCE
//         ]);
//         return new RedirectResponse($url);
        return $this->redirectToRoute('infinito_api_rest_layer_read', [
            'identity' => HomepageFixtureSource::SLUG,
            'layer' => LayerType::SOURCE,
            '_format' => RESTResponseType::HTML,
        ]);
    }
}
