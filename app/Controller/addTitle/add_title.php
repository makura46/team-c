<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Theme;
use Model\Dao\Items;

// 会員登録ページコントローラ
$app->get('/add/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'addTitle/add_title.twig', $data);

});

// 会員登録処理コントローラ
$app->post('/add/', function (Request $request, Response $response) {
	$session = $this->session->get("user_info");
	if (empty($session)) {
		return $response->withRedirect('/index/');
	}

    //POSTされた内容を取得します
    $data = $request->getParsedBody();

	foreach ($data as $val) {
		if (strlen($val) == 0) {
			return $this->view->render($response, 'addTitle/add_title.twig', $data);
		}
	}

	$theme = new Theme($this->db);
	$items = new Items($this->db);

	$check = $theme->select(array("title" => $data["title"]));
    if ($check) {

        //入力項目がマッチしない場合エラーを出す
        $data["error"] = "この大会名は入力済みです";

        // 入力フォームを再度表示します
        return $this->view->render($response, 'addTitle/add_title.twig', $data);

    }

	$created = date('Y-m-d H:i:s');
	$start = $created;
	$finish = date('Y-m-d H:i:s', strtotime('+10 minute'));

	$themeID = $theme->insert(array("title"=>$data["title"], "detail"=>$data["detail"], "imgPath"=>"", "start"=>$start, "finish"=>$finish, "created"=>$created));

	foreach ($data as $key => $val) {
		if ($key == 'title' || $key == '') {
			continue;
		}
		$items->insert(array('name'=>$val, 'themeId'=>$themeID, 'created'=>$created));
	}

    // 登録完了ページを表示します。
    return $this->view->render($response, 'addTitle/add_title_done.twig', $data);

});
