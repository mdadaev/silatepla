<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$class = 'sect-one__project';
if(strlen($arParams["IMG_CLASS"])) {
    $class = $arParams["IMG_CLASS"];
}
?>
<section class="sect-one <?=$class?> white-color"
         style="background: url(<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>")">
<div class="container1-my">
    <h2 data-wow-duration="2s" data-wow-delay="3s" class="h-title sect-one__title wow fadeInDown">
        <?= $arResult["DISPLAY_PROPERTIES"]["TITLE"]["VALUE"] ?><br>
        <strong class="sect-one__bigtext"> <?= $arResult["DISPLAY_PROPERTIES"]["SUB_TITLE_FIRST"]["VALUE"] ?></strong>
    </h2>
    <? if ($arResult["DISPLAY_PROPERTIES"]["SUB_TITLE_SECOND"]["VALUE"]) { ?>
        <p data-wow-duration="2s" data-wow-delay="3200ms" class="manufac-mintitle wow fadeInDown animated"
           style="visibility: visible; animation-duration: 2s; animation-delay: 3200ms;">
            <?= $arResult["DISPLAY_PROPERTIES"]["SUB_TITLE_SECOND"]["VALUE"] ?></p>
    <? } ?>
    <ul class="sect-one__list
    <?=($arResult["PROPERTIES"]["BENEFITS_COLUMNS"]["VALUE"] == "Y")?"sect-one__list_half":""?>
    <?=($arResult["PROPERTIES"]["BENEFITS_CENTER"]["VALUE"] == "Y")?"sect-one__list_margbot":""?>">
        <?
        $counter = 0;
        $delay = 3200;
        foreach ($arResult["PROPERTIES"]["BENEFITS"]["~VALUE"] as $key => $arBenefit) {
            if (empty($arResult["PROPERTIES"]["BENEFITS"]["DESCRIPTION"])) {
                ?>
                <li data-wow-duration="1s" data-wow-delay="<?= $delay ?>ms"
                    class="sect-one__list-item wow <?= ($counter % 2 == 0) ? "fadeInLeft" : "fadeInRight" ?> ">
                    <svg class="sect-one__chek-pic" width="44px" height="43px">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg-symbolsfrhx4leg66r.svg#checkmark"></use>
                    </svg>
                    <?= $arBenefit ?>
                </li>
            <?
            } else {
                ?>
                <li data-wow-duration="1s" data-wow-delay="<?= $delay ?>ms"
                    class="sect-one__list-item wow <?= ($counter % 2 == 0) ? "fadeInLeft" : "fadeInRight" ?>
                    <?=($arResult["PROPERTIES"]["BENEFITS_COLUMNS"]["~VALUE"] == "Y")?"sect-one__list-item__half":""?>
                    <?=($arResult["PROPERTIES"]["BENEFITS_CENTER"]["~VALUE"] == "Y")?"sect-one__list-item_flwrap":""?>">
                    <svg class="sect-one__chek-pic <?=($arResult["PROPERTIES"]["BENEFITS_COLUMNS"]["~VALUE"] == "Y")?"sect-one__chek-pic_manu":""?>" width="44px" height="43px">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg-symbolsfrhx4leg66r.svg#checkmark"></use>
                    </svg>
                    <p class="sect-one_manufacture__bigtext"> <?= $arBenefit ?></p>

                    <p class="sect-one_manufacture__mintext"> <?= $arResult["PROPERTIES"]["BENEFITS"]["~DESCRIPTION"][$key] ?></p>
                </li>
            <?
            }
            $counter++;
            $delay += 200;
        }
        ?>

    </ul>


    <div class="sect-one__buttons">
        <?
        $counter = 0;
        foreach ($arResult["PROPERTIES"]["BUTTONS"]["VALUE"] as $key => $arButton) {
            ?>
            <a href="#kontakt-f" data-wow-duration="1s" data-wow-delay="3200ms"
               class="btn <?= ($counter % 2 == 0) ? " btn_green sect-one__greenbtn" : "btn_red sect-one__redbtn" ?> js-fan-windows wow <?= ($counter % 2 == 0) ? "fadeInLeft" : "fadeInRight" ?>">
                <b class="sect-one__btn-bold"> <?= $arButton ?></b><?= $arResult["PROPERTIES"]["BUTTONS"]["DESCRIPTION"][$key] ?>
            </a>

            <?$counter++;
        }?>

    </div>
</div>
</section>
