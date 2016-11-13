<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="modal fade bounceRightIn" id="feedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-easein="bounceLeftIn">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="icon icon-close-big"></span>
                </button>

            </div>
            <div class="modal-body">
                <form name="iblock_add" class="form " action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="submit-success" value="<?= $arResult["OK"] ?>"/>

                    <div class="row">
                        <? if ($arResult["OK"] == "Y") { ?>

                            <div class="col-xs-12 form-controls modal-success">
                                <h4 class="modal-title success">Отзыв отправлен</h4>
                                <div class="col-xs-12 form-controls modal-success" id="form_ok2">Мы обязательно рассмотрим ваше обращение</div>
                                </form>
                            </div>
                            <?
                            return;
                        } ?>
                        <div class="col-xs-12">
                            <h4 class="modal-title">Написать отзыв</h4>
                            <? if ($arResult["ERRORS"]) {
                                ShowError($arParams["ERROR_MESSAGE"]);
                            } ?>
                        </div>

                        <? foreach ($arResult["PROPERTY_LIST"] as $propertyCode => $property) {
                            switch ($property["TYPE"]) {
                                case "T":
                                    ?>
                                    <div class="col-xs-12 form-controls">
                                        <div>
                                            <label>  <?= $property["NAME"] ?>
                                                <? if ($property["REQUARED"]) { ?>
                                                    <span class="required">*</span>
                                                <? } ?>
                                            </label>
                                        </div>

                <textarea class="" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>
                    cols="30" rows="5" name="<?= $propertyCode ?>"><?= $property["VALUE"] ?></textarea>
                                    </div>
                                    <?
                                    break;
                                case "EMAIL":
                                    ?>
                                    <div class="col-xs-12 col-sm-6 form-controls">
                                        <div class="row">
                                            <div class="col-xs-12 ">
                                                <div>
                                                    <label>  <?= $property["NAME"] ?>
                                                        <? if ($property["REQUARED"]) { ?>
                                                            <span class="required">*</span>
                                                        <? } ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 ">
                                                <input class="" type="email" name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>
                                                    value="<?= $property["VALUE"] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                    break;
                                case "PHONE":
                                    ?>
                                    <div class="col-xs-12 col-sm-6 form-controls">
                                        <div class="row">
                                            <div class="col-xs-12 ">
                                                <div>
                                                    <label>  <?= $property["NAME"] ?>
                                                        <? if ($property["REQUARED"]) { ?>
                                                            <span class="required">*</span>
                                                        <? } ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 ">
                                                <input class="" type="tel" name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>
                                                    value="<?= $property["VALUE"] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                    break;
                                case "L":
                                    ?>
                                    <div class="col-xs-12 col-sm-6 form-controls">
                                        <div class="row">
                                            <div class="col-xs-12 ">
                                                <div>
                                                    <label>  <?= $property["NAME"] ?>
                                                        <? if ($property["REQUARED"]) { ?>
                                                            <span class="required">*</span>
                                                        <? } ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 ">
                                                <select class="custom-select" name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>>
                                                    <? foreach ($property["VALUES"] as $valueType) { ?>
                                                        <option value="<?= $valueType["ID"] ?>" <?= ($valueType["ID"] == $property["VALUE"]) ? "selected" : "" ?>><?= $valueType["VALUE"] ?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                    break;
                                case "E":
                                    switch ($propertyCode) {
                                        case "SERVICE":
                                            ?>
                                            <div class="col-xs-12 col-sm-6 form-controls">
                                                <div class="row">

                                                    <div class="col-xs-12 ">

                                                        <select class="custom-select js-reviews-service" name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>>
                                                            <option value="0">Выберите направление</option>
                                                            <? foreach ($arResult["SERVICES"] as $arService) { ?>
                                                                <option value="<?= $arService["ID"] ?>" <?= ($arService["ID"] == $property["VALUE"]) ? "selected" : "" ?>><?= $arService["NAME"] ?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <? break;
                                        case "SPECIALIST":
                                            ?>
                                            <div class="col-xs-12 col-sm-6 form-controls">
                                                <div class="row">

                                                    <div class="col-xs-12 ">

                                                        <select class="custom-select js-reviews-specialists" name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>>
                                                            <option value="0">Выберите специалиста</option>
                                                            <? foreach ($arResult["SPECIALISTS"] as $arSpecialist) { ?>
                                                                <option value="<?= $arSpecialist["ID"] ?>" <?= ($arSpecialist["ID"] == $property["VALUE"]) ? "selected" : "" ?>><?= $arSpecialist["NAME"] ?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <? break;
                                        default:
                                            ?>
                                            <div class="col-xs-12 col-sm-6 form-controls">
                                                <div class="row">
                                                    <div class="col-xs-12 ">
                                                        <div>
                                                            <label>  <?= $property["NAME"] ?>
                                                                <? if ($property["REQUARED"]) { ?>
                                                                    <span class="required">*</span>
                                                                <? } ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 ">
                                                        <select class="custom-select" name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>>
                                                            <? foreach ($property["VALUES"] as $valueType) { ?>
                                                                <option value="<?= $valueType["ID"] ?>" <?= ($valueType["ID"] == $property["VALUE"]) ? "selected" : "" ?>><?= $valueType["VALUE"] ?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?
                                    }
                                    break;
                                case "HIDDEN":
                                    ?>
                                    <div class="col-xs-12 col-sm-6 form-controls">
                                        <input type="hidden" name="<?= $propertyCode ?>" value="<?= $property["VALUE"] ?>"/>
                                    </div>
                                    <? break;
                                default:
                                    ?>
                                    <div class="col-xs-12 col-sm-6 form-controls">
                                        <div class="row">
                                            <div class="col-xs-12 ">
                                                <div>
                                                    <label>  <?= $property["NAME"] ?>
                                                        <? if ($property["REQUARED"]) { ?>
                                                            <span class="required">*</span>
                                                        <? } ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 ">
                                                <input class="" type="text" name="<?= $propertyCode ?>" <?= ($property["REQUARED"] == 1) ? "required" : "" ?>
                                                    value="<?= $property["VALUE"] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <? break;
                            }
                        } ?>

                        <div class="col-xs-12 form-controls">
                            <input class="btn btn-yellow" type="submit" value="<?= GetMessage("SUBMIT") ?>"/>
                            <input name="submit-form" type="hidden" value="Y"/>
                            <span class="form-description">
                                <span class="required">*</span><?= GetMessage("REQUIRED") ?></span>
                        </div>

                    </div>
                </form>

            </div>

        </div>
    </div>
</div>