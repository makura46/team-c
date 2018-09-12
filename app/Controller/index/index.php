<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

	$session = $this->session->get("user_info");
	if (!empty($session)) {
		return $response->withRedirect('/top/');
	}

	$data = [];

	return $this->view->render($response, '/index/index.twig', $data);

}); 



