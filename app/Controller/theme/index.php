<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Theme;

$app->get('/theme/', function (Request $request, Response $response){
    $data = array();
    // Render index view
    return $this->view->render($response, 'theme/index.twig', $data);

});

$app->post('/theme/', function (Request $request, Response $response) {

    //themeDAOをインスタンス化
    $theme = new Theme($this->db);

    //POSTされた内容を取得します
    $data = $request->getParsedBody();
    $param["id"] = $data["id"];

    $result = $theme->select($param, "", "", "", true);

    if($result == $param["id"]){
        $data["theme"] = $data["theme"] + 1;
        $theme->update($data);
        var_dump($data);
    }

    $param["title"] = $data["title"];
    $param["theme"] = $data["theme"];
    $param["themeID"] = $data["themeID"];

    //入力された情報から比べる物を取得
    $data = $theme->select($param, "", "", "", true);

    // Render index view
    return $this->view->render($response, 'theme/theme.twig', $data);

});