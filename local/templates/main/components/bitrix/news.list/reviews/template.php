<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!$arResult['ITEMS']) {
    return;
}
?>


<div class="redbord-top"></div>
<h2 data-wow-delay="500ms" class="h-title reviews-se__h-title wow fadeInDown"><?= $arParams["TITLE"] ?></h2>

<div class="reviews">

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
        <div data-wow-delay="<?= $delay ?>ms" data-wow-duration="1500ms" class="reviews__item wow fadeInDown"
             id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
            <div class="reviews__cite">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/content/review.png" alt="" class="reviews__cite-pic">
            </div>
            <div class="reviews__body">
                <p class="reviews__name"><?= $arItem['NAME'] ?></p>

                <p class="reviews__post"><?= $arItem['PROPERTIES']["COMPANY"]["VALUE"] ?></p>

                <div class="reviews__minired-line"></div>
                <p class="reviews__texts"><?= $arItem['PREVIEW_TEXT'] ?></p>
            </div>
        </div>


        <?
        $delay += 400;
    }

    if ($arParams['DISPLAY_BOTTOM_PAGER']) {
        print $arResult['NAV_STRING'];
    }
    ?>
</div>
