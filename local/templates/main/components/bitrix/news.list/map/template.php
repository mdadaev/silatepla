<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

if (!$arResult['ITEMS']) {
	return;
}
?>
<? if($arParams["SHOW_BORDER_TOP"] == "N") { ?>
    <div class="redbord-top"></div>
<? } ?>
<section class="<?=$arParams["SHOW_BORDER_TOP"] != "N" ? 'objects-sec' : 'objects-sec__no-border' ?>">
    <div class="container1-my">
        <h2 class="h-title objects-sec__h-title wow fadeInDown">карта объектов</h2>
        <div class="map">
            <div id="bigmap" class="vv"></div>
        </div>
    </div>
    <?foreach($arResult['ITEMS'] as $arItem) {
        $arCoords = explode(",",$arItem['PROPERTIES']["MAP"]["VALUE"]);
        $coordX = $arCoords[0];
        $coordY = $arCoords[1];
        ?>
        <div class="js-placemark" data-name="<?=$arItem["NAME"]?>" data-coord-x="<?=$coordX?>" data-coord-y="<?=$coordY?>"></div>
    <?}?>
</section>
