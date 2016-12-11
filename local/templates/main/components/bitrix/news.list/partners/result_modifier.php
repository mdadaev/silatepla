<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}
$items = array();
foreach( $arResult['ITEMS'] as $key => $arItem)
    if( empty($arItem['PROPERTIES']['SECTION']['VALUE_XML_ID']) || $arItem['PROPERTIES']['SECTION']['VALUE_XML_ID'] == $arParams['SECTION'] )
        $items[$key] = $arItem;
$arResult['ITEMS'] = $items;