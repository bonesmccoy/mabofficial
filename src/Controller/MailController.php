<?php

namespace Mab\Controller;

use Slim\Csrf\Guard;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

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

            $subject = 'Mail from Mabofficial';
            $messageBody = trim($request->getParam('message'));
            $senderEmail = trim($request->getParam('email'));
            $senderName = trim($request->getParam('firstName'));

            if (v::email()->validate($senderEmail) &&
                v::alnum()->notBlank()->validate($senderName)
            ) {
                $message = new \Swift_Message(
                    $subject,
                    filter_var($messageBody, FILTER_SANITIZE_STRING)
                );
                $message
                    ->setSender($senderEmail, $senderName)
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
        }

        return $response->withJson($data);
    }
}
