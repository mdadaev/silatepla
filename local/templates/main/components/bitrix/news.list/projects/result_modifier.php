<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as $index => &$arItem) {
    // Если нет анонса, но есть детальная - делаем анонсную из детальной.
    if ($arItem['DETAIL_PICTURE']['ID'] && !$arItem['PREVIEW_PICTURE']['ID']) {
        $photoResize = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array("width" => $arParams['PREVIEW_PICTURE_W'], "height" => $arParams['PREVIEW_PICTURE_H']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $arItem['PREVIEW_PICTURE']['SRC'] = $photoResize['src'];
    }
    elseif ($arItem['PREVIEW_PICTURE']['ID']) { // есть анонсная - режем
        $photoResize = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array("width" => $arParams['PREVIEW_PICTURE_W'], "height" => $arParams['PREVIEW_PICTURE_H']), BX_RESIZE_IMAGE_EXACT);
        $arItem['PREVIEW_PICTURE']['SRC'] = $photoResize['src'];
    }
}
unset($arItem);