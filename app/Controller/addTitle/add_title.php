<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Tornament;


// 会員登録ページコントローラ
$app->get('/add/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'addTitle/add_title.twig', $data);

});

// 会員登録処理コントローラ
$app->post('/add/', function (Request $request, Response $response) {

    //POSTされた内容を取得します
    $data = $request->getParsedBody();

    //ユーザーDAOをインスタンス化
    $tornament = new Tornament($this->db);

    //入力されたメールアドレスの会員が登録済みかどうかをチェックします
    if ($tornament->select(array("title" => $data["title"]))) {

        //入力項目がマッチしない場合エラーを出す
        $data["error"] = "この大会名は入力済みです";

        // 入力フォームを再度表示します
        return $this->view->render($response, 'addTitle/add_title.twig', $data);

    }

    // 登録完了ページを表示します。
    return $this->view->render($response, 'addTitle/_done.twig', $data);

});
