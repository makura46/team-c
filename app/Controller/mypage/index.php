<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;


// 会員登録ページコントローラ
$app->get('/mypage/', function (Request $request, Response $response) {



    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'mypage/mypage.twig', $data);

});