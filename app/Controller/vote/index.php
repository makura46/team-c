<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Theme;
use Model\Dao\Vote;

$app->get('/vote/', function (Request $request, Response $response){

    // Render index view
    return $this->view->render($response, 'vote/vote.twig', $data);

});

$app->post('/vote/', function (Request $request, Response $response) {

    //themeDAOをインスタンス化
    $theme = new Theme($this->db);

    $param["title"] = $data["title"];
    //$param["vote"] = $data["vote"];
    $param["themeID"] = $data["themeID"];

    //入力された情報から会員情報を取得
    $data = $theme->select($param, "", "", 9999, true);

    // Render index view
    return $this->view->render($response, 'vote/vote.twig', $data);

});