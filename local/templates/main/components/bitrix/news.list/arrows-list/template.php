<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!$arResult['ITEMS']) {
    return;
}
?>

<ul class="footer__list">


    <?
    if ($arParams['DISPLAY_TOP_PAGER']) {
        print $arResult['NAV_STRING'];
    }
    $delay = 700;
    foreach ($arResult['ITEMS'] as $arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $showLink = !$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);

        ?>
        <li  data-wow-delay="<?= $delay ?>ms" data-wow-duration="1200ms" class="footer__list-item wow fadeInDown" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
            <div class="footer__list-link">
                <svg class="footer__list-pic" width="13.66px" height="10px">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg-symbolsu29rl4bo6r.svg#red-arrow"></use>
                </svg>
                <?= $arItem['NAME'] ?>
            </div>
        </li>

        <?
        $delay += 200;
    }

    if ($arParams['DISPLAY_BOTTOM_PAGER']) {
        print $arResult['NAV_STRING'];
    }
    ?>
</ul>

