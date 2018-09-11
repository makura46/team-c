<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Theme;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

	$theme = new Theme($this->db); // Themeテーブルのインスタンスを作成

	$param['theme'] = '%';

	$data = $theme->select($param, "", "", 9999, true);  // Themeテーブルから9999件のデータを取得

	for ($data['theme'] as $

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});

