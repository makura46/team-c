<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Theme;
use Model\Dao\Vote;

$app->get('/result/', function (Request $request, Response $response){

    // Render index view
    return $this->view->render($response, 'result/result.twig', $data);

});

$app->post('/result/', function (Request $request, Response $response) {

    //POSTされた内容を取得します
    $data = $request->getParsedBody();

    //themeDAOをインスタンス化
    $theme = new Theme($this->db);

    $param["title"] = $data["title"];
    $param["vote"] = $data["vote"];
    $param["themeID"] = $data["themeID"];

    //入力された情報から比べる物と票数を取得
    $data = $theme->select($param, "", "", 9999, true);

    // Render index view
    return $this->view->render($response, 'result/result.twig', $data);

});