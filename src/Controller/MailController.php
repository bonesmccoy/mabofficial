<?php

namespace Mab\Controller;

use Slim\Csrf\Guard;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class MailController
 * @package Mab\Controller
 */
class MailController extends AbstractController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response)
    {
        $data = [];

        if (false === $request->getAttribute('csrf_success')) {
            $data = [
                'success' => false,
            ];
        } else {

            $mabMailTo = $this->container->get('mab_mailto');

            $message = new \Swift_Message(
                'Mail from Mabofficial',
                $request->getParam('message')
            );
            $message
                ->setSender($request->getParam('email'), $request->getParam('firstName'))
                ->addTo($mabMailTo);

            /** @var \Swift_Mailer $mailer */
            $mailer = $this->container->get('mailer');
            $mailer->send($message);

            /** @var Guard $csrf */
            $csrf = $this->container->get('csrf');

            $data = [
                'success' => true,
                $csrf->getTokenNameKey() => $csrf->getTokenName(),
                $csrf->getTokenValueKey() => $csrf->getTokenValue(),
            ];
        }

        return $response->withJson($data);
    }
}
