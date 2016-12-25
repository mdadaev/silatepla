<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as &$arItem) {
    if (!empty($arItem['PREVIEW_PICTURE'])) {
        $photoResize = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array("width" => 354, "height" => 502), BX_RESIZE_IMAGE_EXACT);
        $arItem['PREVIEW_PICTURE']['SRC'] = $photoResize['src'];
    }

    if (!empty($arItem['DETAIL_PICTURE'])) {
        $photoResize = \CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array("width" => 800, "height" => 99999999), BX_RESIZE_IMAGE_EXACT);
        $arItem['DETAIL_PICTURE']['SRC'] = $photoResize['src'];
    }

    if(!empty($arItem["PROPERTIES"]['ADD_PHOTO'])) {
        foreach ($arItem["PROPERTIES"]['ADD_PHOTO']['VALUE'] as &$photo) {
            $photo = \CFile::ResizeImageGet($photo, array("width" => 800, "height" => 99999999), BX_RESIZE_IMAGE_EXACT);
        }
    }
}
unset($photo);
unset($arItem);