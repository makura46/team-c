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
	public function voteCount($id, $table) {
		$queryBuilder = new QueryBuilder($this->db);

		$name = $table->getTableName();

		$query = $queryBuilder
			->select('SUM(*), CONUT(*)')
			->from($this->_table_name . "," . $name)
			->orderBy(":id", "DESC")
			->setParameter(":id", $id)
			->groupBy('themeId')
			->execute();

		return $query->FetchALL();
		
	}




}
