<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

if (!$arResult['ITEMS']) {
	return;
}
?>

<div class="timing-lists">
	<?
	if ($arParams['DISPLAY_TOP_PAGER']) {
		print $arResult['NAV_STRING'];
	}
	$counter = 0;
    $arEffects = array("bounceInLeft","bounceInLeft","bounceInLeft");
	foreach($arResult['ITEMS'] as $arItem) {
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		$showLink = !$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);
		if($counter%3==0){
            $counter = 0;
        }

        ?>
        <div data-wow-delay="500ms" class="timing-lists__item wow <?=$arEffects[$counter]?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
            <?if (is_array($arItem['PREVIEW_PICTURE'])) {?>
                <img class="news-list-image img-responsive" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"/>
            <?}?>
            <p class="timing-lists__text"><?=$arItem['PREVIEW_TEXT']?></p>
        </div>

		<?
        $counter++;
	}
	
	if ($arParams['DISPLAY_BOTTOM_PAGER']) {
		print $arResult['NAV_STRING'];
	}
	?>
</div>
