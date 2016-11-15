<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}
?>
<section class="objects-sec">
    <div class="container1-my">
        <h2 class="h-title objects-sec__h-title wow fadeInDown"><?=$arResult["PROPERTIES"]["DETAIL_NAME"]["VALUE"]?></h2>
        <h3 class="h-title objects-sec__mini-title wow fadeInDown"><?=$arResult["PROPERTIES"]["DETAIL_NAME_DESCRIPTION"]["VALUE"]?></h3>
        <div class="objects">
            <div class="objects__fxwrap">
                <?if(!empty($arResult["PROPERTIES"]["PHOTO"]["VALUE"])){?>
                <aside class="objects__left">
                    <div data-width="552" data-ratio="3/2" data-nav="thumbs" data-thumbborderwidth="5" data-thumbmargin="20" data-thumbwidth="170" data-thumbheight="120" data-fit="cover" class="fotorama">
                        <? if( !empty($arResult['DETAIL_PICTURE']['SRC']) )
                        {
                            $photoResize = \CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'],array("width"=>550,"height"=>350),BX_RESIZE_IMAGE_EXACT)
                            ?><a href="<?=$arResult['DETAIL_PICTURE']['SRC'];?>">
                                <img src="<?=$photoResize['src']?>">
                            </a><?
                        }
                        foreach ($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as $key => $photo) {
                            $photoResize = \CFile::ResizeImageGet($photo,array("width"=>550,"height"=>350),BX_RESIZE_IMAGE_EXACT)?>
                            <a href="<?=\CFile::GetPath($photo);?>">
                                <img src="<?=$photoResize['src']?>">
                            </a>
                        <? } ?>
                    </div>
                </aside>
                <?
                }

                elseif($arResult['DETAIL_PICTURE']['SRC']) {
                    ?>

                    <aside class="objects__left">
                        <div>
                            <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>">
                        </div>
                    </aside>

                    <?
                }
                ?>
                <aside class="objects__right">
                    <div class="objects__table">
                        <? foreach ($arResult["PROPERTIES"]["PARAMETRS"]["VALUE"] as $key => $parametr) { ?>
                            <div class="objects__table-line">
                                <div class="objects__table-cell left"><b class="objects__bold"><?= $parametr ?>:</b>
                                </div>
                                <div class="objects__table-cell right">
                                    <p class="objects__descr"><?= $arResult["PROPERTIES"]["PARAMETRS"]["DESCRIPTION"][$key] ?></p>
                                </div>
                            </div>

                        <? } ?>

                    </div>
                    <h3 class="h-title objects__mini-title wow fadeInDown">объем работ компании</h3>
                    <div class="objects__minired-line"></div>
                    <?=$arResult["DETAIL_TEXT"]?>

                </aside>
            </div>
        </div>
    </div>
</section>
<div class="page__buffer"></div>
</section>