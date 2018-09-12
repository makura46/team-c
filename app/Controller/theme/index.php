<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;
use Model\Dao\Theme;
use Model\Dao\Items;
use Model\Business\pointUtil;

$app->get('/theme/{id}', function (Request $request, Response $response, $args){
    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    //theme.name取得
    $theme_dao = new Theme($this->db);
    $items = new Items($this->db);

    $param["id"] = $args['id'];
    $theme = $theme_dao->select($param, "", "", false);

    if (empty($theme)) {
        return $response->withRedirect('/top/');
    }

    $data["theme"] = $theme;

    $param_item["themeId"] = $theme["id"];
    $data["items"] = $items->select($param_item, "", "", "", true);
    //var_dump($data["items"]);
    
    //$data = array();

    // Render index view
    return $this->view->render($response, 'theme/theme.twig', $data);

});

$app->post('/theme/', function (Request $request, Response $response, $args) {
    $req_data = $request->getParsedBody();

    $point = new PointUtil($this->db);
    $point->subPoint($req_data["userId"], $req_data["point"], $req_data["item"]);
    $select_param = array("id" => $req_data["userId"]);
    //var_dump($select_param);

    //対象ユーザーの情報を取得する
    $user = new User($this->db);
    $result = $user->select($select_param, "", "", "1", false);

    //セッションのユーザー情報を更新
    $this->session->set('user_info', $result);

    return $response->withRedirect('/top/');

});