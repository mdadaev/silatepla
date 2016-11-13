<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!$arResult['ITEMS']) {
    return;
}
?>

<ul class="sect-one__list sect-one__list_hard-quest">


    <?
    if ($arParams['DISPLAY_TOP_PAGER']) {
        print $arResult['NAV_STRING'];
    }
    $delay = 600;
    foreach ($arResult['ITEMS'] as $arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $showLink = !$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);

        ?>
        <li data-wow-duration="1s" data-wow-delay="<?= $delay ?>ms" class="sect-one__list-item wow fadeInLeft"
            id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
            <svg class="sect-one__chek-pic" width="44px" height="43px">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg-symbolsu29rl4bo6r.svg#checkmark"></use>
            </svg>
            <?= $arItem['NAME'] ?>
        </li>

        <?
        $delay += 100;
    }

    if ($arParams['DISPLAY_BOTTOM_PAGER']) {
        print $arResult['NAV_STRING'];
    }
    ?>
</ul>

