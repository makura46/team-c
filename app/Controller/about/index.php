<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/about/', function (Request $request, Response $response) {

	$data = [];

	return $this->view->render($response, '/about/index.twig', $data);

}); 