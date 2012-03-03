<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property ORM_City $city
 * @property ORM_Street $street
 * @property string $birthday
 * @property string $phone
*/

class Model_Person extends ORM {
	
	/**
	 * Rule definitions for validation
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			'first_name' => array(
				array('not_empty'),
			),
			'middle_name' => array(
				array('not_empty'),
			),
			'last_name' => array(
				array('not_empty'),
			),
			'city' => array(
				array('not_empty'),
			),
			'street' => array(
				array('not_empty'),
			),
			'birthday' => array(
				array('not_empty'),
				array('date'),
			),
			'phone' => array(
				array('not_empty'),
				array('phone'),
			),
			
		);
	}
	
	/**
	 * Filter definitions for validation
	 *
	 * @return array
	 */
	function filters()
	{
		return array(
			'birthday' => array(
	            array('Date::formatted_time', array(':value', 'Y-m-d')),
			),
		);
	}
	
	/**
	 * Label definitions for validation
	 *
	 * @return array
	 */
	public function labels()
	{
		return array (
			'id' => 'id',
			'first_name' => 'Имя',
			'middle_name' => 'Отчество',
			'last_name' => 'Фамилию',
			'city' => 'Город',
			'street' => 'Улицу',
			'birthday' => 'Дату рождения',
			'phone' => 'Номер телефона',
		);
	}
	
	/**
	 * Handles retrieval of all model values, relationships, and metadata.
	 *
	 * @param   string $column Column name
	 * @return  mixed
	 */
	public function __get($column)
	{
		if($column == 'name')
			return $this->last_name.' '.$this->first_name.' '.$this->middle_name;
		
		return parent::__get($column);
	}
} // End Man