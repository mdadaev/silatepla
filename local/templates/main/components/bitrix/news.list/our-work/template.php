<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!$arResult['ITEMS']) {
    return;
}
?>

<div class="section our-work">
    <div class="container1-my">
        <h2 data-wow-delay="500ms" class="h-title our-work__title wow fadeInDown">Наша работа для Вас, это...</h2>

        <div class="our-work__wrap">
            <?
            if ($arParams['DISPLAY_TOP_PAGER']) {
                print $arResult['NAV_STRING'];
            }

            foreach ($arResult['ITEMS'] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                $showLink = !$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);
                ?>

                <div data-wow-delay="500ms" class="our-work__item wow fadeInLeft" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                    <?=$arItem["PROPERTIES"]["SVG"]["~VALUE"]["TEXT"]?>
                    <p class="our-work__item-title"><?= strtoupper ($arItem['NAME']) ?></p>
                    <?= $arItem['PREVIEW_TEXT'] ?>
                </div>

            <?
            }

            if ($arParams['DISPLAY_BOTTOM_PAGER']) {
                print $arResult['NAV_STRING'];
            }
            ?>
        </div>

    </div>
    <a href="#kontakt-f" data-wow-delay="1200ms" class="btn btn_red sect-one__redbtn js-fan-windows wow fadeIn"><b class="sect-one__btn-bold">свяжитесь с нами</b>для оценки стоимости	</a>
</div>

