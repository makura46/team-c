<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Vote;


// 会員登録ページコントローラ
$app->get('/mypage/', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    //ユーザー情報を取得するためインスタンス化
    $user = new User($this->db);

    //ログインユーザー情報を取得する
    $data["user"] = $user->select(array("id" => $this->session["user_info"]["id"]), "", "", "", false);

    $vote = new Vote($this->db);

    $data["vote_history"] = $vote->getUserHistory($data["user"]["id"]);

    // Render index view
    return $this->view->render($response, 'mypage/mypage.twig', $data);

});