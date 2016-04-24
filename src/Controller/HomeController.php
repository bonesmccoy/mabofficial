<?php

namespace Mab\Controller;

use Slim\Csrf\Guard;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class HomeController
 */
class HomeController extends AbstractController
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return string
     */
    public function __invoke(Request $request, Response $response, $args = array())
    {
        /** @var Guard $csrf */
        $csrf = $this->container->get('csrf');

        $content = [
            'csrfTokenName' => $csrf->getTokenName(),
            'csrfTokenNameKey' => $csrf->getTokenNameKey(),
            'csrfTokenValueKey' => $csrf->getTokenValueKey(),
            'csrfTokenValue' => $csrf->getTokenValue(),
        ];

        $view = $this->container->get('view');

        return $view->render(
            $response,
            'Controller/home.html.twig',
            $content
        );
    }
}
