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
	
} // End Welcome