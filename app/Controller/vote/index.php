<?php

use Slim\Http\Request;
use Model\Dao\User;


    // Render index view
    return $this->view->render($response, 'vote/vote.twig', $data);
    
});

$app->post('/vote/', function (Request $request, Response $response) {

    //themeDAOをインスタンス化
    $user = new User($this->db);

    $param["title"] = $data["title"];
    $param["vote"] = $vote["vote"]; 

    //入力された情報から会員情報を取得
    $result = $theme->select($param, "", "", "", true);

    // Render index view
    return $this->view->render($response, 'vote/vote.twig', $data);

});