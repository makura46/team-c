<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Theme;
use Model\Dao\Items;

$app->get('/theme/{id}', function (Request $request, Response $response, $args){
    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    //theme.name取得
    $theme_dao = new Theme($this->db);
    $items = new Items($this->db);

    $param["id"] = $args['id'];
    $theme = $theme_dao->select($param, "", "", false);

    $data["theme"] = $theme;

    $param_item["themeId"] = $theme["id"];
    $data["items"] = $items->select($param_item, "", "", "", true);
    var_dump($data["items"]);
    
    //$data = array();

    // Render index view
    return $this->view->render($response, 'theme/theme.twig', $data);

});

$app->post('/theme', function (Request $request, Response $response, $args) {

    //themeDAOをインスタンス化
    $theme = new Theme($this->db);

    //POSTされた内容を取得します
    $data = $request->getParsedBody();
    $param["id"] = $data["id"];
    
    $result = $theme->select($param, "", "", "", true);

    if($result == $param["id"]){
        $data["theme"] = $data["theme"] + 1;
        $theme->update($data);
    }

    $param["title"] = $data["title"];
    $param["theme"] = $data["theme"];
    $param["themeID"] = $data["themeID"];

    //入力された情報から比べる物を取得
    $data = $theme->select($param, "", "", "", true);

    // Render index view
    return $this->view->render($response, 'theme/theme.twig', $data);

});