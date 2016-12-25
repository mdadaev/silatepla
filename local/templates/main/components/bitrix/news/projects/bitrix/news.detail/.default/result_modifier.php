<?php
if( !empty($arResult['DETAIL_PICTURE']['SRC']) ) {
    $photoResize = \CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'],array("width"=>550,"height"=>350),BX_RESIZE_IMAGE_EXACT);
    $arResult['DETAIL_PICTURE']['SRC'] = $photoResize['src'];
}

if(!empty($arResult["PROPERTIES"]['PHOTO'])) {
    foreach ($arResult["PROPERTIES"]['PHOTO']['VALUE'] as &$photo) {
        $photo = \CFile::ResizeImageGet($photo, array("width" => 550, "height" => 350), BX_RESIZE_IMAGE_EXACT);
    }
}
unset($photo);