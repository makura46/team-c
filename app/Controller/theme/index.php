<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Theme;
use Model\Dao\Vote;
use Model\Dao\Items;

$app->get('/theme/{id}', function (Request $request, Response $response, $args){

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    $theme_dao = new Theme($this->db);

    $param["id"] = $args['id'];
    $theme = $theme_dao->select($param, "", "", true);
    
    $data["theme"] = $theme;

    // Render index view
    return $this->view->render($response, 'theme/theme.twig', $data);

});
