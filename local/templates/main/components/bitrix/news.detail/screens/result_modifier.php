<?php
if( !empty($arResult['DETAIL_PICTURE']['SRC']) ) {
    $photoResize = \CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'],array("width"=>1920,"height"=>540),BX_RESIZE_IMAGE_EXACT);
    $arResult['DETAIL_PICTURE']['SRC'] = $photoResize['src'];
}