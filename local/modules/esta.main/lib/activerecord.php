<?php

namespace Esta\Main;

/**
 * Реализация паттерна "Active record"
 * 
 * Ограничения и упрощения:
 * - MySQL only;
 * - первичный ключ состоит из одного поля целочисленного типа;
 * - поля типа boolean хранятся в БД в виде char(1) с возможными значениями "Y" или "N";
 * - не отработан момент нескольких последовательных save() в режиме транзакции.
 */
class ActiveRecord
{
	/**
	 * Исключение: запись не найдена
	 */
	const EXCEPTION_NOT_FOUND = 1;
	
	/**
	 * Формат даты-времени для полей datetime
	 */
	const DATETIME_FORMAT = "Y-m-d H:i:s";
	
	/**
	 * Формат даты для полей date
	 */
	const DATE_FORMAT = "Y-m-d";
	
	/**
	 * Формат времени для полей time
	 */
	const TIME_FORMAT = "H:i:s";
	
	/**
	 * Название таблицы
	 *
	 * @var string
	 */
	protected $table = "";
	
	/**
	 * Поле первичного ключа таблицы
	 *
	 * @var string
	 */
	protected $pk = "";
	
	/**
	 * Режим транзакции (записи блокируются до момента сохранения)
	 *
	 * @var boolean
	 */
	protected $transMode = false;
	
	/**
	 * Признак загрузки записи из БД
	 *
	 * @var boolean
	 */
	protected $loaded = false;
	
	/**
	 * Поля записи
	 *
	 * @var array
	 */
	protected $fields = array();
	
	/**
	 * Доп. св-ва полей
	 *
	 * @var array
	 */
	protected $extra = array();
	
	/**
	 * Соответcтвие полей БД вида "поле записи => поле БД"
	 *
	 * @var array
	 */
	protected $map = array();
	
	/**
	 * Измененные с момета инициализации поля
	 *
	 * @var array
	 */
	protected $dirty = array();
	
	/**
	 * Создает новый экземпляр active record
	 *
	 * @param boolean $transMode Режим транзакции
	 * @return void
	 */
	public function __construct($transMode = false)
	{
		if (!$this->table) {
			throw new Exception("Table name is undefined.");
		}
		if (!$this->pk) {
			throw new Exception("Table primary key is undefined.");
		}
		if (!$this->fields) {
			throw new Exception("Record fields is undefined.");
		}
		if (!$this->map) {
			throw new Exception("Fields map is undefined.");
		}
		
		$this->transMode = $transMode;
	}
	
	/**
	 * Загружает запись по первичному ключу
	 *
	 * @param integer $id Значение первичного ключа
	 * @param string $className Имя создаваемого класса
	 * @param boolean $transMode Режим транзакции
	 * @return ActiveRecord
	 */
	protected static function load($id, $className, $transMode = false)
	{
		global $DB;
		$id = intval($id);
		
		$instance = new $className($transMode);
		$instance->loadFromDB($instance->pk . " = '" . $DB->ForSql($id) . "'");
		
		return $instance;
	}
	
	/**
	 * Формирует запись по данным из БД
	 *
	 * @param string $where Условие выборки записи
	 * @return void
	 */
	protected function loadFromDB($where)
	{
		global $DB;
		
		//Запускаем транзакацию при работе в режиме транзакции
		if ($this->transMode) {
			$this->transaction();
		}
		
		//Ищем запись таблицы БД по условию
		$recordset = $DB->Query(
				"SELECT ". implode(",", array_values($this->map)) . "
				FROM " . $this->table . "
				WHERE ". $where .
				($this->transMode ? " FOR UPDATE" : ""),
			false,
			"File: " . __FILE__ . "<br>Line: " . __LINE__
		);
		if (!($data = $recordset->Fetch())) {
			throw new Exception(sprintf("Record is not found"), self::EXCEPTION_NOT_FOUND);
		}
		
		//Сохраняем значения
		foreach ($this->map as $localName => $dbName) {
			if (!array_key_exists($dbName, $data)) {
				continue;
			}
			
			$this->setValue($localName, $data[$dbName]);
		}
		
		//Помечаем запись, как загруженную из БД
		$this->loaded = true;
		
		//Очищаем массив измененных полей
		$this->dirty = array();
	}
	
	/**
	 * Сохраняет запись в БД
	 *
	 * @return void
	 */
	public function save()
	{
		global $DB;
		
		//Набираем массив значений для Update()|Insert()
		$data = array();
		foreach ($this->map as $localName => $dbName) {
			//Если запись загружена из БД, то сохраняем только измененные поля
			if ($this->loaded && !in_array($localName, $this->dirty)) {
				continue;
			}
			
			//Обрабатываем поле
			$val = $this->fields[$localName];
			
			if ($val === null) {
				$data[$dbName] = "NULL";
				continue;
			}
			
			if (is_bool($val)) {
				$val = $val ? "Y" : "N";
			}
			
			$data[$dbName] = "'" . $DB->ForSql($val) . "'";
		}
		
		if ($this->loaded) {//Если запись загружена из БД - обновляем
			//Если есть что обновить - обновляем
			if ($data) {
				$pkVal = $this->fields[array_search($this->pk, $this->map)];
				$DB->Update(
					$this->table,
					$data,
					"WHERE " . $this->pk . " = '" . $DB->ForSql($pkVal) . "'",
					"File: " . __FILE__ . "<br>Line: " . __LINE__,
					false,
					true
				);
				
				//Кидаем исключение в случае ошибки
				if ($DB->db_Error) {
					if ($this->transMode) {
						$this->rollback();
					}
					throw new Exception($DB->db_Error);
				}
			}
		} else {//Если запись новая - добавляем
			if (!$data) {
				throw new Exception("No data to insert");
			}
			
			$key = array_search($this->pk, $this->map); 
			$this->$key = $DB->Insert(
				$this->table,
				$data,
				"File: " . __FILE__ . "<br>Line: " . __LINE__,
				false,
				"",
				true
			);
			
			//Кидаем исключение в случае ошибки
			if ($DB->db_Error) {
				if ($this->transMode) {
					$this->rollback();
				}
				throw new Exception($DB->db_Error);
			}
			
			$this->loaded = true;
		}
		
		//При работе в режиме транзакции осуществлем ее закрытие, если требуется
		if ($this->transMode) {
			$this->commit();
			//TODO: реализовать последовательные save() в transMode
			$this->transMode = false;
		}
		
		//Очищаем массив измененных полей
		$this->dirty = array();
	}
	
	/**
	 * Открывает транзакцию
	 *
	 * @return void
	 */
	protected function transaction()
	{
		global $DB;
		//$DB->Query("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		$DB->StartTransaction();
		
		//Кидаем исключение в случае ошибки
		if ($DB->db_Error) {
			throw new Exception($DB->db_Error);
		}
	}
	
	/**
	 * Завершает транзакцию
	 *
	 * @return void
	 */
	protected function commit()
	{
		global $DB;
		$DB->Commit();
		
		//Кидаем исключение в случае ошибки
		if ($DB->db_Error) {
			throw new Exception($DB->db_Error);
		}
	}
	
	/**
	 * Отменяет транзакцию
	 *
	 * @return void
	 */
	public function rollback()
	{
		global $DB;
		$DB->Rollback();
		
		//Кидаем исключение в случае ошибки
		if ($DB->db_Error) {
			throw new Exception($DB->db_Error);
		}
	}
	
	/**
	 * Возвращает значение свойства
	 *
	 * @param string $name Название свойства
	 * @return mixed
	 */
	protected function getValue($name)
	{
		if (!array_key_exists($name, $this->fields)) {
			throw new Exception(sprintf("Property '%s' is not found.", $name));
		}
		
		return $this->fields[$name];
	}
	
	/**
	 * Устанавливает значение свойства
	 *
	 * @param string $name Название свойства
	 * @param mixed $value Значение свойства
	 * @return void
	 */
	protected function setValue($name, $value)
	{
		//Проверки
		if (!array_key_exists($name, $this->fields)) {
			throw new Exception(sprintf("Property '%s' is not found.", $name));
		}
		
		if ($this->loaded && $this->map[$name] == $this->pk && $this->fields[$name] != $value) {
			throw new Exception("Changing primary key for loaded record is not allowed.");
		}
		
		//Определяем тип поля, если он не указан
		if (!isset($this->extra[$name]["type"])) {
			$this->extra[$name]["type"] = gettype($this->fields[$name]);
		}
		
		//Помечаем поле, как измененное
		if (!in_array($name, $this->dirty)) {
			$this->dirty[] = $name;
		}
		
		//Обрабатываем поле, которое может быть null
		if (isset($this->extra[$name]["null"]) && $this->extra[$name]["null"] && $value === null) {
			$this->fields[$name] = $value;
			return;
		}
		
		//Производим приведение типа значения поля
		switch ($this->extra[$name]["type"]) {
			case "boolean":
				if($value === "Y" || $value === "N")
					$this->fields[$name] = $value === "Y";
				else
					$this->fields[$name] = (boolean) $value;
				break;
			case "integer":
				$this->fields[$name] = intval($value);
				break;
			case "double":
				$this->fields[$name] = floatval($value);
				break;
			case "datetime":
				$this->fields[$name] = date(self::DATETIME_FORMAT, ctype_digit($value) ? intval($value) : strtotime($value));
				break;
			case "date":
				$this->fields[$name] = date(self::DATE_FORMAT, ctype_digit($value) ? intval($value) : strtotime($value));
				break;
			case "time":
				$this->fields[$name] = date(self::TIME_FORMAT, ctype_digit($value) ? intval($value) : strtotime($value));
				break;
			default:
				$this->fields[$name] = $value;
		}
	}
	
	/**
	 * Возвращает запись в виде массива значений
	 *
	 * @return array
	 */
	public function toArray()
	{
		return $this->fields;
	}
	
	/**
	 * Возвращает значение свойства (magic)
	 *
	 * @param string $name Название свойства
	 * @return mixed
	 */
	public function __get($name)
	{
		return $this->getValue($name);
	}
	
	/**
	 * Устанавливает значение свойства (magic)
	 *
	 * @param string $name Название свойства
	 * @param mixed $value Значение свойства
	 * @return void
	 */
	public function __set($name, $value)
	{
		$this->setValue($name, $value);
	}
	
	/**
	 * Проверяет наличие свойства (magic)
	 *
	 * @param string $name Название свойства
	 * @return boolean
	 */
	public function __isset($name)
	{
		return isset($this->fields[$name]);
	}
}