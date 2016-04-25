<?php

namespace App;

use Mab\Service\ConfigReader;
use Slim\Container;
use Slim\Csrf\Guard;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Swift_Mailer;
use Swift_SmtpTransport;

/**
 * Class Bootstrap
 */
class Bootstrap
{
    /**
     * @param Container $container
     */
    public function run(Container $container)
    {
        $container->offsetSet('root_dir', __DIR__."/..");

        $container->offsetSet('config', function (Container $container) {
            $rootDir = $container->get('root_dir');
            $configurationFilePath = $rootDir.'/app/config.yml';
            $configReader = new ConfigReader($container);

            return $configReader->loadConfiguration($rootDir, $configurationFilePath);
        });

        $container->offsetSet('csrf', function (Container $container) {
            $guard =  new Guard();
            $guard->setFailureCallable(function (Request $request, Response $response, $next) {
                $request = $request->withAttribute("csrf_success", false);

                return $next($request, $response);
            });

            return $guard;
        });

        $container->offsetSet('view', function (Container $container) {

            $templatePath = $container->get('config')['slim']['templates']['path'];
            $templateCachePath = $container->get('config')['slim']['templates']['cache'];

            $view = new Twig(
                $templatePath,
                [ 'cache' => $templateCachePath]
            );

            $view->addExtension(new TwigExtension(
                $container->get('router'),
                $container->get('request')->getUri()
            ));

            return $view;
        });

        $container->offsetSet('mailer', function (Container $container) {

            $config = $container->get('config');
            $transport = Swift_SmtpTransport::newInstance(
                $config['mailer']['server']['host'],
                $config['mailer']['server']['port']
            );


            return  Swift_Mailer::newInstance($transport);
        });
    }
}
