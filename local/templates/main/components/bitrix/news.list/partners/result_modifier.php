<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}
$items = array();
foreach( $arResult['ITEMS'] as $key => $arItem) {

    if (!empty($arItem['PREVIEW_PICTURE'])) {
        $photoResize = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array("width" => 120, "height" => 90), BX_RESIZE_IMAGE_EXACT);
        $arItem['PREVIEW_PICTURE']['SRC'] = $photoResize['src'];
    }


    if( empty($arItem['PROPERTIES']['SECTION']['VALUE_XML_ID']) || in_array($arParams['SECTION'], $arItem['PROPERTIES']['SECTION']['VALUE_XML_ID'])) {
        $items[$key] = $arItem;
    }

}
$arResult['ITEMS'] = $items;