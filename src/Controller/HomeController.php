<?php

namespace Mab\Controller;

use Slim\Csrf\Guard;
use Interop\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Class HomeController
 */
class HomeController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * HomeController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

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
