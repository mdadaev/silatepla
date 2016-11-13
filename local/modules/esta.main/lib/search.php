<?php

namespace Esta\Main;

/**
 * Класс для организации нестандартного поиска
 */
class Search
{
	/**
	 * Обработчик, вызываемый перед переиндексацией документа
	 *
	 * @param array $data Поля индексируемого документа
	 * @return array Модифицированный или исходный $data
	 */
	public static function onBeforeIndex($data)
	{
		try {
			if (is_array($data)) {
				//Для инфоблоков логика индексации реализуется в обслуживающем инфоблок классе
				if ($data['MODULE_ID'] == 'iblock') {
					$iblock = Iblock\Prototype::getInstance($data['PARAM2']);
					$isSection = substr($data['ITEM_ID'], 0, 1) == 'S';
					$methodName = 'onBeforeSearchIndex' . ($isSection ? 'Section' : 'Element');
					if (method_exists($iblock, $methodName)) {
						return call_user_func(array($iblock, $methodName), $data);
					}
				}
			}
		} catch(\Exception $e) {
		}
		
		return $data;
	}
}