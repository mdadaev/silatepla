<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

foreach($arResult['ITEMS'] as &$arItem) {
	if( !empty($arItem['PREVIEW_PICTURE']) ) {
		$photoResize = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'],array("width"=>600,"height"=>415),BX_RESIZE_IMAGE_EXACT);
		$arItem['PREVIEW_PICTURE']['SRC'] = $photoResize['src'];
	}
}
unset($arItem);