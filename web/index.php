<?php

use Mab\Service\ConfigReader;
use Slim\Http\Request;
use Slim\Http\Response;

require __DIR__.'/../vendor/autoload.php';

session_start();
$container = new \Slim\Container();

$app = new \Slim\App($container);

$container->offsetSet('root_dir', __DIR__."/..");

$container->offsetSet('config', function (\Slim\Container $container) {
    $rootDir = $container->get('root_dir');
    $configurationFilePath = $rootDir.'/app/config.yml';
    $configReader = new ConfigReader($container);

    return $configReader->loadConfiguration($rootDir, $configurationFilePath);
});

$container->offsetSet('csrf', function (\Slim\Container $container) {
    $guard =  new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function (Request $request, Response $response, $next) {
        $request = $request->withAttribute("csrf_success", false);

        return $next($request, $response);
    });

    return $guard;
});

$container->offsetSet('view', function (\Slim\Container $container) {

    $templatePath = $container->get('config')['slim']['templates']['path'];
    $templateCachePath = $container->get('config')['slim']['templates']['cache'];

    $view = new \Slim\Views\Twig(
        $templatePath,
        [ 'cache' => $templateCachePath]
    );

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->get('router'),
        $container->get('request')->getUri()
    ));

    return $view;
});

$container->offsetSet('mailer', function (\Slim\Container $container) {

    $config = $container->get('config');
    $transport = Swift_SmtpTransport::newInstance(
        $config['mailer']['server']['host'],
        $config['mailer']['server']['port']
    );


    return  Swift_Mailer::newInstance($transport);
});

$app->add($container->get('csrf'));

$app->get('/', '\Mab\Controller\HomeController');
$app->post('/sendmail', '\Mab\Controller\MailController');
$app->run();
