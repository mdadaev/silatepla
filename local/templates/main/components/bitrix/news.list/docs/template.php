<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!$arResult['ITEMS']) {
    return;
}
?>

<div class="section dosc white-color">
    <div class="container1-my">
        <h2 data-wow-delay="500ms" class="h-title h-title__dosc wow fadeInDown">наши документы</h2>

        <div class="slider center-slider slider-docs">
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
                    <div class="slider-docs__item" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                        <a href="<?= ($arItem['DETAIL_PICTURE']['SRC']) ? $arItem['DETAIL_PICTURE']['SRC'] : $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                           rel="docs" class="slider-docs__link fancybox ">
                            <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>"
                                 class="slider-docs__pictue">
                        </a>
                        <?if (!empty($arItem["PROPERTIES"]['ADD_PHOTO'])) {
                            foreach ($arItem["PROPERTIES"]['ADD_PHOTO']['VALUE'] as $photo) {
                                $photoSrc = CFile::GetPath($photo);
                                ?>

                                <a c href="<?=$photoSrc?>"
                                   rel="docs" class=" hidden  fancybox ">

                                </a>

                            <?
                            }
                        }?>
                    </div>

                <?
                }
                ?>

            <?
            }

            if ($arParams['DISPLAY_BOTTOM_PAGER']) {
                print $arResult['NAV_STRING'];
            }
            ?>
        </div>
    </div>
</div>
