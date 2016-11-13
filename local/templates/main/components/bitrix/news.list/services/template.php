<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!$arResult['ITEMS']) {
    return;
}
?>

<section class="main-pad we-do">
    <div class="container1-my">
        <h2 class="h-title we-do__h-title wow fadeInDown">Что мы делаем</h2>
        <?
        if ($arParams['DISPLAY_TOP_PAGER']) {
            print $arResult['NAV_STRING'];
        }
        $counter = 0;
        foreach ($arResult['ITEMS'] as $arItem) {

            // Добавляем поддержку интерфейса эрмираж
            

            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $showLink = !$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);
            ?>
            <div class="row we-do__block between-sm <?= ($counter % 2 && $counter !=0) ? "reverse" : "" ?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
                <div data-wow-delay="500ms" class="we-do__col-left wow fadeInLeft">
                    <div class="green-bord"><?
                        if (is_array($arItem['PREVIEW_PICTURE'])) {
                            ?>
                            <img class="green-bord__pictue" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                 alt="<?= $arItem['NAME'] ?>"/>
                        <? } ?>
                    </div>
                </div>
                <div data-wow-delay="500ms" class="we-do__col-right wow fadeInRight"
                     id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                    <h3 class="h-title3"><?= $arItem['NAME'] ?></h3>

                    <div class="red-line"></div>
                    <?= $arItem['PREVIEW_TEXT'] ?>
                    <? if($arItem['PROPERTIES']['LINK']['VALUE']) { ?>
                        <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>"
                            class="btn btn_red we-do__redbtn header__btn_red">
                            Подробнее
                        </a>
                    <? }
                    else { ?>
                    <a href="#kontakt-f"
                       class="btn btn_red we-do__redbtn header__btn_red js-fan-windows">
                        Подробнее
                    </a>
                    <? } ?>
                </div>
            </div>
            <?
            $counter++;
        }

        if ($arParams['DISPLAY_BOTTOM_PAGER']) {
            print $arResult['NAV_STRING'];
        }
        ?>
    </div>
</section>
