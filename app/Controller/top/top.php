<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Theme;
use Model\Dao\Items;
use Model\Dao\Vote;

// TOPページのコントローラ
$app->get('/top/', function (Request $request, Response $response) {
	$session = $this->session->get("user_info");
	if (empty($session)) {
		return $response->withRedirect('/index/');
	}

	$theme = new Theme($this->db); // Themeテーブルのインスタンスを作成
	$items = new Items($this->db); // Itemsテーブルのインスタンスを作成
	$vote = new Vote($this->db);   // Voteテーブルのインスタンスを作成	

	$data = $theme->select([], 'id', "DESC", "", true);  
	
	foreach ($vote->voteCount($items) as $values){
		$voteCountData[$values['themeId']] = $values;
	}
	foreach($data as $key => $value){
		$data[$key]['items'] = $items->select(['themeId'=>$value['id']], 'itemId', '', 3, true);
        $data[$key]['votes'] = $voteCountData[$value['id']]['votes'] ?? 0;
        $data[$key]['point'] = $voteCountData[$value['id']]['point'] ?? 0;
        $data[$key]['imgPath'] = $data[$key]['imgPath'] ? $data[$key]['imgPath'] : 'http://y-ryu.xii.jp/wp/wp-content/uploads/2016/09/shouldnotdo.jpg';
	}

	$data['record'] = $data;

	// Render index view
	return $this->view->render($response, '/top/index.twig', $data);

});
