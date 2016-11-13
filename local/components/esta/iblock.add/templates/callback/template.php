<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

    <div class="js-popup-form-container" data-id="<?=$arParams["IBLOCK_ID"]?>">
    <form name="iblock_add-<?=$arParams["IBLOCK_ID"]?>" class="form forma js-popup-form" action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="submit-success" value="<?= $arResult["OK"] ?>"/>
        <input type="hidden" name="IBLOCK_ID" value="<?=$arParams["IBLOCK_ID"]?>"/>
        <? if ( $arResult["OK"] == "Y") {?>
        <div class="forma__thanks">
            <p class="forma__big-thanks"><b>Ваша заявка успешно отправлена!</b></p>

            <p class="forma__text">Наши менеджеры свяжутся с Вами<br>в ближайшее время.</p>

            <p class="forma__text">Спасибо за обращение.</p>
        </div>
    </form>
    </div>

<?
return;
} ?>
<? if ($arResult["ERRORS"]) {
    ShowError($arParams["ERROR_MESSAGE"]);
} ?>

<? foreach ($arResult["PROPERTY_LIST"] as $propertyCode => $property) {
    switch ($property["TYPE"]) {
        case "T":
            ?>
            <div class="form-group <? if ($property["ERRROR"] == "Y") {
                echo "has-error";
            } ?>">

                <textarea  placeholder="<?= $property["NAME"] ?> <? if ($property["REQUARED"]) {
                    echo '*';
                } ?>" rows="4" class="forma__inpt" <?= ($property["REQUARED"] == 1) ? "required" : "" ?> cols="" name="<?= $propertyCode ?>"><?= $property["VALUE"] ?></textarea>
            </div>
            <?
            break;
        case "EMAIL":
            ?>
            <div class="form-group <? if ($property["ERRROR"] == "Y") {
                echo "has-error";
            } ?>">

                <input class="forma__inpt" type="email"
                       name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>
                       value="<?= $property["VALUE"] ?>"
                       placeholder="<?= $property["NAME"] ?> <? if ($property["REQUARED"]) {
                           echo '*';
                       } ?>"/>
            </div>

            <?
            break;
        case "PHONE":
            ?>
            <div class=" form-group <? if ($property["ERRROR"] == "Y") {
                echo "has-error";
            } ?>">
                <input class="forma__inpt" type="tel"
                       name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>
                       placeholder="<?= $property["NAME"] ?> <? if ($property["REQUARED"]) {
                           echo '*';
                       } ?>"
                       value="<?= $property["VALUE"] ?>"/>
            </div>
            <?
            break;
        case "L":
            ?>
            <div class=" form-group <? if ($property["ERRROR"] == "Y") {
                echo "has-error";
            } ?>">
                <select class="form-control"
                        name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>>
                    <? foreach ($property["VALUES"] as $valueType) {
                        ?>
                        <option
                            value="<?= $valueType["ID"] ?>" <?= ($valueType["ID"] == $property["VALUE"]) ? "selected" : "" ?>><?= $valueType["VALUE"] ?></option>
                    <?
                    } ?>
                </select>
            </div>
            <?
            break;
        case "HIDDEN":
            ?>
            <div class="">
                <input type="hidden" name="<?= $propertyCode ?>" value="<?= $property["VALUE"] ?>"/>
            </div>
            <? break;
        default:
            ?>
                <div class="  form-group <? if ($property["ERRROR"] == "Y") {
                    echo "has-error";
                } ?>">

                    <input class="forma__inpt" type="text"
                           name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>
                           placeholder="<?= $property["NAME"] ?> <? if ($property["REQUARED"]) {
                               echo '*';
                           } ?>"
                           value="<?= $property["VALUE"] ?>"/>

                </div>
            <? break;
    }
} ?>

<button class="forma__send btn" type="submit"><?= GetMessage("SUBMIT") ?></button>
<input name="submit-form" type="hidden" value="Y"/>
</form>
</div>
