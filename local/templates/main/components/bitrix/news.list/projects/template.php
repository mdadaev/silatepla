<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!$arResult['ITEMS']) {
    return;
}
?>

<h2 class="h-title we-do__h-title wow fadeInDown"><?= $arParams["TITLE"] ?></h2>

<div class="row we-do__block between-sm between-sm_grid">
    <?
    if ($arParams['DISPLAY_TOP_PAGER']) {
        print $arResult['NAV_STRING'];
    }

    
    $counter = 0;
    foreach ($arResult['ITEMS'] as &$arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $showLink = !$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);


    ?>
    <? if ($counter % 2 == 0 && $counter != 0){ ?>
</div>
<div class="row we-do__block between-sm between-sm_grid">
    <? } ?>
    <div data-wow-delay="500ms"
         class="we-do__col-half wow <?= ($counter % 2 == 0) ? "fadeInLeft" : "fadeInRight" ?> "
         id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
        <div class="green-bord">
            <div class="green-bord__picture-wrap">
                <? if (!empty($arItem["PREVIEW_PICTURE"])) { ?>
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>"
                         class="green-bord__picture-w100">
                <? } ?>

                <div class="green-bord__overlay">
                    <p class="green-bord__overlay-main-descr">
                        <b class="green-bord__bold"><?= $arItem["NAME"] ?></b>
                    </p>
                    <?  if ($arItem["PROPERTIES"]["PARAMETRS"]["VALUE"]) {
                        ?>
                        <div class="green-bord__flexwrap">
                            <? foreach ($arItem["PROPERTIES"]["PARAMETRS"]["VALUE"] as $key => $parametr) { ?>
                                <div class="green-bord__line"><b
                                        class="green-bord__name-descr"><?= $parametr ?></b>

                                    <p class="green-bord__name-full"><?= $arItem["PROPERTIES"]["PARAMETRS"]["DESCRIPTION"][$key] ?></p>
                                </div>
                            <? } ?>
                        </div>

                    <? } ?>
                    <a  href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn  we-do__redbtn btn_desciption">Описание</a>

                </div>
            </div>
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

