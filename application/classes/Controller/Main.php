<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Template {

	public function action_index()
	{
		$people = ORM::factory('person')->find_all();
		
		$this->template->bind('people', $people);
	}

	public function action_add()
	{
		$this->auto_render = FALSE;
		if($this->request->is_ajax())
		{
			$json = array();
			try
			{
				$item = ORM::factory('person')->values($_POST)->save();
				$json['type'] = 'success';
				$json['data'] = $item->as_array();
				$json['message'] = 'Добовление прошло успешно';
			}
			catch (ORM_Validation_Exception $e)
			{
				$json['type'] = 'error';
				$json['message'] = $e->errors('');				
			}
			
			$this->response->body(json_encode($json));
			
		}
		else
		{
			throw HTTP_Exception::factory('404', 'Page not found');
		}

	}
	
	public function action_edit()
	{
		$this->auto_render = FALSE;
		if($this->request->is_ajax())
		{
			$json = array();
			try
			{
				$item = ORM::factory('person', (int)$this->request->post('id'));
				if($item->loaded())
				{
					$item->values($_POST)->save();
					$json['type'] = 'success';
					$json['data'] = $item->as_array();
					$json['message'] = 'Изменения прошло успешно';
				}
				else
				{
					$json['type'] = 'error';
					$json['message'] = 'Человека с таким ID нет в базе';
				}
			}
			catch (ORM_Validation_Exception $e)
			{
				$json['type'] = 'error';
				$json['message'] = $e->errors('');				
			}
			
			$this->response->body(json_encode($json));
			
		}
		else
		{
			throw HTTP_Exception::factory('404', 'Page not found');
		}

	}
	
	public function action_load()
	{
		$this->auto_render = FALSE;
		if($this->request->is_ajax()){
			$id = (int) $this->request->param('id');
			$item = ORM::factory('person', $id);
			$this->response->body(json_encode($item->as_array()));
		}
		else
		{
			throw HTTP_Exception::factory('404', 'Page not found');
		}
	}
	
	public function action_remove()
	{
		$this->auto_render = FALSE;
		if($this->request->is_ajax()){
			$id = (int) $this->request->post('id');
			$item = ORM::factory('person', $id);
			$json = array();
			if($item->loaded())
			{
				$item->delete();
				$json['type'] = 'success';
				$json['message'] = 'Удаление прошло успешно';
			}
			else
			{
				$json['type'] = 'error';
				$json['message'] = 'Человека с таким ID нет в базе';
			}

			$this->response->body(json_encode($json));
		}
		else
		{
			throw HTTP_Exception::factory('404', 'Page not found');
		}
	}	
	
	public function action_install()
	{
		$this->auto_render = TRUE;
		$db = Database::instance();
		$db->query(Database::UPDATE, 'DROP TABLE IF EXISTS `people`', FALSE);
		$db->query(Database::UPDATE, '
			CREATE TABLE `people` (
			  `id` int(11)  NOT NULL AUTO_INCREMENT,
			  `first_name` varchar(50)  NOT NULL,
			  `middle_name` varchar(50)  NOT NULL,
			  `last_name` varchar(50)  NOT NULL,
			  `city` varchar(100)  NOT NULL,
			  `street` varchar(100)  NOT NULL,
			  `birthday` DATE  NOT NULL,
			  `phone` varchar(50)  NOT NULL,
			  PRIMARY KEY (`id`)
			)
			ENGINE = MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			', false);
		$this::redirect();
	}
	
} // End Welcome