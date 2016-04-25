<?php

use Mab\Service\ConfigReader;
use Slim\Http\Request;
use Slim\Http\Response;

require __DIR__.'/../vendor/autoload.php';

session_start();
$container = new \Slim\Container();

$bootstrap = new App\Bootstrap();
$bootstrap->run($container);

$app = new \Slim\App($container);




$app->add($container->get('csrf'));

$app->get('/', '\Mab\Controller\HomeController');
$app->post('/sendmail', '\Mab\Controller\MailController');
$app->run();
