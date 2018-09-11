<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

	$session = $this->session("user_info");
	if (!empty($session)) {
		return $response->withRedirect('/top/index.twig');
	}

	$data = [];

	return $this->view->render($response, '/index/index.twig', $data);

}); 



