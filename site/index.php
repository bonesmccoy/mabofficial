<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/../vendor/autoload.php';

define('KERNEL_DIR', __DIR__."/..");

session_start();
$app = new \Slim\App();
$container = $app->getContainer();

$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard();
};

$container['view'] = function ($container) {

    $view = new \Slim\Views\Twig(
        KERNEL_DIR.'/templates',
        [ 'cache' => KERNEL_DIR.'/cache']
    );
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};

$app->add($container->get('csrf'));

$app->get('/', function (Request $request, Response $response) {

    $content = [
        'csrfTokenName' => $this->csrf->getTokenName(),
        'csrfTokenNameKey' => $this->csrf->getTokenNameKey(),
        'csrfTokenValueKey' => $this->csrf->getTokenValueKey(),
        'csrfTokenValue' => $this->csrf->getTokenValue(),
    ];

    return $this->view->render(
        $response,
        'content.html.twig',
        $content
    );
});

$app->run();
