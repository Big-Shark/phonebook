<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {
	
	/**
	 * Returns an array of columns to include in the select query. This method
	 * can be overridden to change the default select behavior.
	 *
	 * @return array Columns to select
	 */
	protected function _build_select()
	{
		$columns = array();

		foreach ($this->_table_columns as $column => $_)
		{
			$columns[] = array($this->_object_name.'.'.$column, $column);// Заменил _table_columns на _object_name, видать недоделка версии 3.3
		}

		return $columns;
	}
	
}
