<?php

namespace Esta\Main;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Локаль
 */
class Locale
{
	/**
	 * Singleton экземпляр Locale
	 *
	 * @var Locale|null
	 */
	protected static $instance = null;
	
	/**
	 * Настройки локали
	 *
	 * @var array
	 */
	public $settings = array(
		'date' => FORMAT_DATE,
		'time' => '',
		'dateTime' => FORMAT_DATETIME,
		'firstDay' => 1,
		'isRTL' => false,
	);
	
	/**
	 * Сообщения локали
	 *
	 * @var array
	 */
	public $messages = array(
		'monthNames' => array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
		'monthNamesShort' => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
		'dayNames' => array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'),
		'dayNamesShort' => array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'),
		'dayNamesMin' => array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'),
		'close' => 'Close',
		'datePicker' => array(
			'prev' => '<Prev',
			'next' => 'Next>',
			'current' => 'Today',
			'showMonthAfterYear' => false,
			'weekHeader' => 'Wk',
			'yearSuffix' => '',
		),
		'timePicker' => array(
			'timeOnlyTitle' => 'Choose time',
			'timeText' => 'Time',
			'hourText' => 'Hours',
			'minuteText' => 'Minutes',
			'secondText' => 'Seconds',
			'millisecText' => 'Milliseconds',
			'currentText' => 'Now',
			'ampm' => true,
		),
		'alert' => array(
			'title' => 'System message',
			'ok' => 'Ok',
		),
	);
	
	/**
	 * Конструктор
	 *
	 * @return void
	 */
	protected function __construct()
	{
		$this->settings = array_merge($this->settings, (array) Loc::getMessage('INDI_MAIN_LOCALE_SETTINGS'));
		$this->messages = array_merge($this->messages, (array) Loc::getMessage('INDI_MAIN_LOCALE_MESSAGES'));
		
		$this->settings['time'] = trim(substr($this->settings['dateTime'], strlen($this->settings['date'])));
	}
	
	/**
	 * Обработчик клонирования
	 *
	 * @return void
	 */
	public function __clone(){
		throw new Exception('Clone denied.');
	}
	
	/**
	 * Возвращает singleton экземпляр Locale
	 *
	 * @return Locale
	 */
	public static function getInstance()
	{
		if (self::$instance === null) {
			self::$instance = new Locale();
		}
		
		return self::$instance;
	}
	
	/**
	 * Возвращает Locale в виде строки в формате JSON
	 *
	 * @return string
	 */
	public function toJSON()
	{
		$backup = $this->settings;
		
		$this->settings['date'] = self::convertFormatToJS($this->settings['date']);
		$this->settings['time'] = self::convertFormatToJS($this->settings['time']);
		$this->settings['dateTime'] = self::convertFormatToJS($this->settings['dateTime']);
		
		$result = json_encode($this);
		
		$this->settings = $backup;
		
		return $result;
	}
	
	/**
	 * Конвертирует формат даты/времени из стандарта PHP в стандарт JS
	 *
	 * @param string $format Формат даты/времени в стандарте PHP
	 * @return string
	 */
	public static function convertFormatToJS($format)
	{
		return str_replace(
			array('YYYY', 'MM', 'DD', 'HH', 'MI', 'SS'),
			array('yy', 'mm', 'dd', 'hh', 'mi', 'ss'),
			$format
		);
	}
}