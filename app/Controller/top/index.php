<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Theme;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

	$theme = new Theme($this->db);

	$param['title'] = '%';

	$data = $theme->select($param, "", "", );

	

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});

