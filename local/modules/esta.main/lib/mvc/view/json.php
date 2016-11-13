<?php

namespace Esta\Main\Mvc\View;

use Esta\Main as Main;

/**
 * JSON MVC view
 *
 */
class Json extends Prototype
{
	/**
	 * Создает новый MVC JSON view
	 *
	 * @param mixed $data Данные view
	 * @return void
	 */
	public function __construct($data = array())
	{
		$this->data = $data;
	}
	
	/**
	 * Отсылает http-заголовки для view
	 *
	 * @return void
	 */
	public function sendHeaders()
	{
		header('Content-type: application/json');
	}
	
	/**
	 * Формирует view
	 *
	 * @return string
	 */
	public function render()
	{
		if (defined('SITE_CHARSET') && SITE_CHARSET != 'UTF-8') {
			return json_encode(Main\Util::convertCharset($this->data, SITE_CHARSET, 'UTF-8'));
		} else {
			return json_encode($this->data);
		}
	}
}