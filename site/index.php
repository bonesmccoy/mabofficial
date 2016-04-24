<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/../vendor/autoload.php';

session_start();
$container = new \Slim\Container();

$app = new \Slim\App($container);

$container->offsetSet('kernel_dir', __DIR__."/..");
$container->offsetSet('mab_mailto', "empirico@gmail.com");

$container->offsetSet('csrf', function (\Slim\Container $container) {
    return new \Slim\Csrf\Guard();
});

$container->offsetSet('view', function (\Slim\Container $container) {

    $kernelDir = $container->get('kernel_dir');

    $view = new \Slim\Views\Twig(
        $kernelDir.'/templates',
        [ 'cache' => $kernelDir.'/cache']
    );

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->get('router'),
        $container->get('request')->getUri()
    ));

    return $view;
});

$container->offsetSet('mailer', function (\Slim\Container $container) {
    $transport = Swift_MailTransport::newInstance();

    return  Swift_Mailer::newInstance($transport);
});

$app->add($container->get('csrf'));
$app->get('/', '\Mab\Controller\HomeController');
$app->post('/sendmail', '\Mab\Controller\MailController');

$app->run();
