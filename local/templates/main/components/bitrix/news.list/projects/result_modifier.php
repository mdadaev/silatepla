<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {die();}

foreach($arResult['ITEMS'] as $index => $arItem)
{
    if( !empty($arItem['DETAIL_PICTURE']['ID']) )
    {
        $photoResize = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'],array("width"=>$arParams['PREVIEW_PICTURE_W'],"height"=>$arParams['PREVIEW_PICTURE_H']),BX_RESIZE_IMAGE_PROPORTIONAL, true );
        $arResult['ITEMS'][$index]['PREVIEW_PICTURE'] = $photoResize;
    }
}
unset($arItem);

//Esta\Main\Console::log($arResult);