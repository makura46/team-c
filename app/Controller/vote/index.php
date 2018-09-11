<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Theme;
use Model\Dao\Vote;

$app->get('/vote/', function (Request $request, Response $response){

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'vote/vote.twig', $data);

});

$app->post('/vote/', function (Request $request, Response $response) {

    //themeDAOをインスタンス化
    $theme = new Theme($this->db);
    $vote = new Vote($this->db);

    //POSTされた内容を取得します
    $data = $request->getParsedBody();
    $param["id"] = $data["id"];

    $result = $vote->select($param, "", "", "", true);

    if($result == $param["id"]){
        $data["vote"] = $data["vote"] + 1;
        $theme->update($data);
        var_dump($data);
    }

    $param["title"] = $data["title"];
    $param["vote"] = $data["vote"];
    $param["themeID"] = $data["themeID"];

    //入力された情報から比べる物を取得
    $data = $theme->select($param, "", "", "", true);

    // Render index view
    return $this->view->render($response, 'vote/vote.twig', $data);

});