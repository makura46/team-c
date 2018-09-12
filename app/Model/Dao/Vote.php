<?php

namespace Model\Dao;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Class Vote
 *
 * Voteテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2018/08/28
 * @package Model\Dao
 */
class Vote extends Dao
{

	// idはソートしたい
	public function voteCount($table) {

		$queryBuilder = new QueryBuilder($this->db);

		$thisTable = $this->getTableName();
		$name = $table->getTableName();

		$query = $queryBuilder
			->select('i.themeId, COUNT(v.userId) AS votes, IFNULL(SUM(v.point), 0) AS point')
			->from($name, 'i')
			->leftJoin('i', $thisTable, 'v', 'v.itemid = i.itemid')
			->groupBy('i.themeId')
			->orderBy("i.themeId", "DESC")
			->execute();

		return $query->FetchALL();
		
	}




}
