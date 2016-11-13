<?php

namespace Esta\Main\Mvc\Controller;

use Esta\Main as Main;
use Esta\Main\Mvc as Mvc;

/**
 * Прототип MVC контроллера
 * 
 * @category	Esta
 * @package		MVC
 */
class Prototype
{
	/**
	 * Request
	 *
	 * @var Bitrix\Main\Context\HttpRequest
	 */
	protected $request = null;
	
	/**
	 * View
	 *
	 * @var Mvc\View\Prototype|null
	 */
	protected $view = null;
	
	/**
	 * Вернуть возвращенные экшном данные как есть, без признака success
	 *
	 * @var boolean
	 */
	protected $returnAsIs = false;
	
	/**
	 * Параметры
	 *
	 * @var array
	 */
	protected $params = array();
	
	/**
	 * Создает новый контроллер
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
	}
	
	/**
	 * "Фабрика" контроллеров
	 *
	 * @param string $name Имя сущности
	 * @return Prototype
	 */
	public static function factory($name)
	{
		$name = preg_replace('/[^A-z0-9_]/', '', $name);
		$className = '\\' . __NAMESPACE__ . '\\' . ucfirst($name);
		
		if (!class_exists($className)) {
			throw new Main\Exception(sprintf('Controller "%s" doesn\'t exists.', $name));
		}
		
		return new $className();
	}
	
	/**
	 * Выполняет экшн контроллера
	 *
	 * @param string $name Имя экшена
	 * @return void
	 */
	public function doAction($name)
	{
		$name = preg_replace('/[^A-z0-9_]/', '', $name);
		$methodName = $name . 'Action';
		
		if (!method_exists($this, $methodName)) {
			throw new Main\Exception(sprintf('Action "%s" doesn\'t exists.', $name));
		}
		
		//JSON view by default
		$this->view = new Mvc\View\Json();
		
		$response = new \stdClass();
		$response->success = false;
		try {
			$response->data = call_user_func(array($this, $methodName));
			$response->success = true;
		} catch(\Exception $e) {
			$response->code = $e->getCode();
			$response->message = $e->getMessage();
		}
		
		try {
			$this->view->setData($this->returnAsIs ? (
				isset($response->data) ? $response->data : null
			) : $response);
			$this->view->sendHeaders();
			print $this->view->render();
		} catch(\Exception $e) {
			print $e->getMessage();
		}
	}
	
	/**
	 * Возвращает код, сгенерированный компонентом Bitrix
	 *
	 * @param string $name Имя компонента
	 * @param string $template Шаблон компонента
	 * @param array $params Параметры компонента
	 * @param mixed $componentResult Данные, возвращаемые компонентом
	 * @return string
	 */
	protected function getComponent($name, $template = '', $params = array(), &$componentResult = null)
	{
		ob_start();
		$componentResult = $GLOBALS['APPLICATION']->IncludeComponent($name, $template, $params);
		$result = ob_get_contents();
		ob_end_clean();
		
		return $result;
	}
	
	/**
	 * Устанавливает параметры из пар в массиве
	 *
	 * @param array $pairs Пары [ключ][значение]
	 * @return void
	 */
	public function setParamsPairs($pairs)
	{
		foreach ($pairs as $name) {
			$value = next($pairs) === false ? null : current($pairs);
			$this->params[$name] = $value;
		}
	}
	
	/**
	 * Возвращает значение входного параметра
	 *
	 * @param string $name Имя параметра
	 * @param mixed $default Значение по умолчанию
	 * @return mixed
	 */
	protected function getParam($name, $default = '')
	{
		$result = array_key_exists($name, $this->params)
			? $this->params[$name]
			: $this->request->get($name);
		
		return $result === null ? $default : $result;
	}
}