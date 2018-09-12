<?php
namespace Model\Business;

use Model\Dao\Vote;
use Model\Dao\User;

/**
 * Class PointUtil
 *
 * PointUtil Classです
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2018/09/12
 */
Class PointUtil
{

    /**
     * @var User _user_dao
     */
    private $_user_dao;

    /**
     * @var Vote _vote_dao
     */

    private $_vote_dao;

    /**
     * PointUtil constructor.
     *
     * PointUtil のコンストラクタです
     *
     * @copyright Ceres inc.
     * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
     * @since 2018/09/12
     * @param $db
     */

    public function __construct($db)
    {
        //ユーザーDaoをインスタンス化
        $this->_user_dao = new User($db);

        //VoteDaoをインスタンス化
        $this->_vote_dao = new Vote($db);
    }

    /**
     * subPoint Function
     *
     * 指定ユーザーIDのポイントを減算するロジックです。
     *
     * @copyright Ceres inc.
     * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
     * @since 2018/09/12
     * @param $user_id
     * @param $sub_point
     * @param $item_id
     * @return string
     */

    public function subPoint($user_id, $sub_point, $item_id)
    {
        //マイナスポイントが指定された場合
        if ($sub_point <= 0) {
            return "指定ポイント数が異常です";
        }

        //マイナスポイントが指定された場合
        if ($sub_point > 500) {
            return "一度に賭けることができるポイント数は500ptまでとなります";
        }

        //対象ユーザー情報を取得するためのクエリを指定
        $select_param = array("id" => $user_id);

        //対象ユーザーの情報を取得する
        $user_info = $this->_user_dao->select($select_param, "", "", "1", false);

        //保持ポイント異常の投票をしようとした場合
        if ($user_info["point"] < $sub_point) {
            return "ポイントが足りません";
        }

        //ポイント減算を行う
        $update_param = array(
            "id" => $user_info["id"],
            "point" => ($user_info["point"]-$sub_point)
        );

        //上記で更新する
        $this->_user_dao->update($update_param);

        //Voteテーブルにレコードを挿入するようなクエリを作る
        $insert_param   =array(
            "itemId" => $item_id,
            "userId" => $user_info["id"],
            "point" => $sub_point
        );

        //上記の投票履歴を挿入する
        $this->_vote_dao->insert($insert_param);

        //OKを返信
        return true;

    }
}