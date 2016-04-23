<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/../vendor/autoload.php';

define('KERNEL_DIR', __DIR__."/..");

$app = new \Slim\App();

// Get container
$container = $app->getContainer();

// Register component on container
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

$app->get('/', function (Request $request, Response $response) {
    return $this->view->render(
        $response,
        'content.html.twig'
    );
});

$app->run();
