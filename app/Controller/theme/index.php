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
    $items_dao = new Items($this->db);

    $param["id"] = $args['id'];
    $theme = $theme_dao->select($param, "", "", true);

    $param["name"] = $data["name"];
    $items = $items_dao->select($param, "", "", true);
    var_dump($item);

    /*{% for itemId in items %}
    <p>{{item.name}}</p>
    {% endfor %}*/
    

    $data["theme"] = $theme;
    $data["items"] = $items;

    // Render index view
    return $this->view->render($response, 'theme/theme.twig', $data);

});
