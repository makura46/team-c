<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Theme;
use Model\Dao\Items;

// TOPページのコントローラ
$app->get('/top/', function (Request $request, Response $response) {
	$session = $this->session->get("user_info");
	if (empty($session)) {
		return $response->withRedirect('/index/');
	}

	$theme = new Theme($this->db); // Themeテーブルのインスタンスを作成
	$items = new Items($this->db); // Itemsテーブルのインスタンスを作成
	$param['id'] = '%';
	$data = $theme->select($param, "id", "DESC", "", true);  // Themeテーブルから9999件のデータを取得
	// テーマIDを利用し、票数の合計を取得
	for ($i = 0; $i < 9999; $i++) { 
		$sum = 0;
		if (isset($data[$i]['id'])) {
			$search['themeId'] = $data[$i]['id'];
			$cnt = $items->select($search, "", "", 9999, true); // Itemsテーブルのカラムを取得
			$sum = count($cnt);
			$data[$i]['vote'] = $sum;
		} else {
			break;
		}   

	}
	$data['record'] = $data;

	// Render index view
	return $this->view->render($response, '/top/index.twig', $data);

});
