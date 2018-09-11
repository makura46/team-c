<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Theme;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

	$theme = new Theme($this->db); // Themeテーブルのインスタンスを作成
	$vote = new Vote($this->db); // Voteテーブルのインスタンスを作成

	$param['theme'] = '%';

	$data = $theme->select($param, "", "", 9999, true);  // Themeテーブルから9999件のデータを取得

	// テーマIDを利用し、票数の合計を取得
	for ($i = 0; $i < 9999; $i++) {	
		$sum = 0;
		if (isset($data[$i]['id']) {
			$search['id'] = $data[$i]['id'];
			$cnt = $theme->select($search, "", "", 9999, true);	// Voteテーブルのカラムを取得
			for ($j = 0; $j < 9999; $j++) {
				if (isset($cnt[$j]['vote']) {
					$sum += $cnt[$j]['vote'];
				} else {
					break;
				}
			} 
			$data[$i]['vote'] = $sum;
		} else {
			break;
		}
	}

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});

