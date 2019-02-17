<?php

namespace Infinito\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Offers an SPA with Vue.js.
 *
 * @see https://vuejs.org/
 * @see https://de.wikipedia.org/wiki/Single-Page-Webanwendung
 *
 * @author kevinfrantz
 */
final class SPAController extends AbstractController
{
    /**
     * @todo put this in an .env file
     *
     * @var int
     */
    const SPA_PORT = 82;

    private function getSpaUrl(Request $request): string
    {
        $url = str_replace('/spa/', '', $request->getUri());
        $url = str_replace('/spa', '', $url);
        $url .= ':'.self::SPA_PORT;

        return $url;
    }

    /**
     * @Route("/spa",methods={"GET"})
     *
     * @return Response
     */
    public function spa(Request $request): RedirectResponse
    {
        return new RedirectResponse($this->getSpaUrl($request));
    }
}
