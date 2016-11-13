<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!$arResult['ITEMS']) {
    return;
}
?>


<h2 data-wow-delay="500ms" class="h-title h-title_partners wow fadeInDown"><?= $arParams["TITLE"] ?></h2>

<div class="partners__wrap">
    <?
    if ($arParams['DISPLAY_TOP_PAGER']) {
        print $arResult['NAV_STRING'];
    }

    foreach ($arResult['ITEMS'] as $arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $showLink = !$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);
        ?>
        <?
        if (is_array($arItem['PREVIEW_PICTURE'])) {
            ?>
            <div class="partners__item" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                <a href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>" class="partners__logolink">
                    <img class="partners__logo-pic" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                         alt="<?= $arItem['NAME'] ?>"/>
                </a>
            </div>
        <? } ?>

    <?
    }

    if ($arParams['DISPLAY_BOTTOM_PAGER']) {
        print $arResult['NAV_STRING'];
    }
    ?>
</div>

