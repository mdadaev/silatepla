<?php
/**
 * Esta module
 * 
 * @category	Esta
 * @revision	$Revision$
 * @date		$Date$
 */


namespace Esta\Main;

/**
 * Базовый каталог модуля
 */
const BASE_DIR = __DIR__;

$event = new \Bitrix\Main\Event('esta.main', 'onModuleInclude');
$event->send();