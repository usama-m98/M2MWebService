<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/** utlises the slim framework in order to form a homepage
for the application to  allow you to send messages through EE m2m client.
*/

$app->get('/', function(Request $request, Response $response) use ($app)
{
    return $this->view->render($response,
        'homepageform.html.twig',
        [
          'css_path' => CSS_PATH,
          'landing_page' => LANDING_PAGE,
          'page_title' => APPLICATION_NAME,
          'page_heading_1' => APPLICATION_NAME,
          'page_text'  => 'An application that lets you Send Messages through EE M2M client and view stored messages',
          'create_message' => LANDING_PAGE . '/createmessage',
          'view_message' => LANDING_PAGE . '/viewmessagedata',
        ]);
})->setName('homepage');