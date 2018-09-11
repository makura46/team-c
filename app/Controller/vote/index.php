<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Theme;
use Model\Dao\Vote;

$app->get('/vote/', function (Request $request, Response $response){

    // Render index view
    return $this->view->render($response, 'vote/index.twig', $data);

});

$app->post('/vote/', function (Request $request, Response $response) {

    //themeDAOをインスタンス化
    $theme = new Theme($this->db);

    //POSTされた内容を取得します
    $data = $request->getParsedBody();

    $param["title"] = $data["title"];
    //$param["vote"] = $data["vote"];
    $param["themeID"] = $data["themeID"];

    //入力された情報から比べる物を取得
    $data = $theme->select($param, "", "", 9999, true);

    // Render index view
    return $this->view->render($response, 'vote/vote.twig', $data);

});