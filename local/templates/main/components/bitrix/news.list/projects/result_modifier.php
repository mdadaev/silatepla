<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {die();}

foreach($arResult['ITEMS'] as $index => $arItem)
{
    // Если нет анонса, но есть детальная - делаем анонсную из детальной.

    if($arItem['DETAIL_PICTURE']['ID'] && !$arItem['PREVIEW_PICTURE']['ID'])   {
        $photoResize = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'],array("width"=>$arParams['PREVIEW_PICTURE_W'],"height"=>$arParams['PREVIEW_PICTURE_H']),BX_RESIZE_IMAGE_PROPORTIONAL, true );
        $photoResize['SRC'] = $photoResize['src'];
        $arResult['ITEMS'][$index]['PREVIEW_PICTURE'] = $photoResize;
    }
}
unset($arItem);