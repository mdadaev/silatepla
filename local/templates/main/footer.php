<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (defined('\Esta\Main\IS_AJAX') && \Esta\Main\IS_AJAX) {
    return;
}
?>
<div class="page__buffer"></div>
</section>
<div class="page__footer">
    <footer class="footer">
        <div class="container1-my">
            <div class="row">
                <div data-wow-delay="500ms" class="col-xs-12 col-sm-4 wow fadeInDown">
                    <a href="/" class="footer__logo">
                        <?$APPLICATION->IncludeFile(
                            '/includes/footer-logo.php',
                            array(),
                            array(
                                'MODE' => 'html',
                                'NAME' => 'Логотип',
                            )
                        )?>
                    </a>

                    <p class="footer__text-under-logo">
                        <?$APPLICATION->IncludeFile(
                            '/includes/footer-copy.php',
                            array(),
                            array(
                                'MODE' => 'html',
                                'NAME' => 'Copyrights',
                            )
                        )?>
                    </p>
                </div>
                <div data-wow-delay="1000ms" class="col-xs-12 col-sm-3 col-sm-offset-1 mob-hide wow fadeInDown">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom",
                        Array(
                            "ROOT_MENU_TYPE" => "bottom",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "bottom",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>

                </div>
                <div data-wow-delay="1500ms" class="col-xs-12 col-sm-3 col-sm-offset-1 mob-hide wow fadeInDown">
                    <div class="footer__col-last">
                        <a href="tel:<?= tplvar('phone');?>" class="footer__vecpic">
                            <svg class="header__pic-svg" width="15px" height="15px">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg-symbolsfrhx4leg66r.svg#phone"></use>
                            </svg>
                            <?= tplvar('phone-view');?></a>
                        <?$APPLICATION->IncludeFile(
                            '/includes/footer-email.php',
                            array(),
                            array(
                                'MODE' => 'php',
                                'NAME' => 'email',
                            )
                        )?>
                        <span class="footer__vecpic footer__vecpic_last">
            <svg class="footer__pic-svg-last" width="10px" height="15px">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg-symbolsfrhx4leg66r.svg#point"></use>
            </svg>
                            <?$APPLICATION->IncludeFile(
                                '/includes/footer-contacts.php',
                                array(),
                                array(
                                    'MODE' => 'html',
                                    'NAME' => 'Контакты',
                                )
                            )?>
                           </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<div id="menu-slide" class="menu-slide">
    <h2 class="menu-slide__title">Меню <span class="menu-slide__back">
            <svg class="menu-slide__arrow" width="284px" height="284px">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg-symbolsfrhx4leg66r.svg#menu_back"></use>
            </svg>
        </span></h2>
    <div id="slide-copymenu" class="menu-slide__container"></div>
</div>
</div>

<div id="zvon" class="js-fan-zvonok ">
<?$APPLICATION->IncludeComponent(
	"esta:iblock.add",
	"callback",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"IBLOCK_TYPE" => "Forms",
		"IBLOCK_ID" => "5",
		"FIELDS" => array(
			0 => "NAME",
			1 => "PHONE",
			2 => "",
		),
		"REQUARED_FIELDS" => array(
			0 => "NAME",
			1 => "PHONE",
			2 => "",
		),
		"NAME_FORMAT" => array(
			0 => "NAME",
		),
		"USE_DATE_IN_NAME" => "Y",
		"ACTIVATE_ELEMENT" => "Y",
		"ERROR_MESSAGE" => "Заполните все обязательные поля",
		"SUCCESS_MESSAGE" => "",
		"CUSTOM_LABELS_NAME" => "Имя",
		"CUSTOM_LABELS_TAGS" => "",
		"CUSTOM_LABELS_DATE_ACTIVE_FROM" => "",
		"CUSTOM_LABELS_DATE_ACTIVE_TO" => "",
		"CUSTOM_LABELS_IBLOCK_SECTION" => "",
		"CUSTOM_LABELS_PREVIEW_TEXT" => "",
		"CUSTOM_LABELS_PREVIEW_PICTURE" => "",
		"CUSTOM_LABELS_DETAIL_TEXT" => "",
		"CUSTOM_LABELS_DETAIL_PICTURE" => "",
		"CUSTOM_LABELS_PHONE" => "Телефон",
		"POPUP_MODE" => "Y",
	),
	false
);?>
    </div>
<div id="kontakt-f" class="js-fan-zvonok">

<?$APPLICATION->IncludeComponent(
    "esta:iblock.add",
    "callback",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "IBLOCK_TYPE" => "Forms",
        "IBLOCK_ID" => "6",
        "FIELDS" => array(
            0 => "NAME",
            1 => "EMAIL",
            2 => "PHONE",
            3 => "PREVIEW_TEXT",
        ),
        "REQUARED_FIELDS" => array(
            0 => "NAME",
            1 => "EMAIL",
            2 => "PHONE",
        ),
        "NAME_FORMAT" => array(
            0 => "NAME",
        ),
        "USE_DATE_IN_NAME" => "Y",
        "ACTIVATE_ELEMENT" => "Y",
        "ERROR_MESSAGE" => "Заполните все обязательные поля",
        "SUCCESS_MESSAGE" => "",
        "CUSTOM_LABELS_NAME" => "ФИО",
        "CUSTOM_LABELS_TAGS" => "",
        "CUSTOM_LABELS_DATE_ACTIVE_FROM" => "",
        "CUSTOM_LABELS_DATE_ACTIVE_TO" => "",
        "CUSTOM_LABELS_IBLOCK_SECTION" => "",
        "CUSTOM_LABELS_PREVIEW_TEXT" => "Описание задачи",
        "CUSTOM_LABELS_PREVIEW_PICTURE" => "",
        "CUSTOM_LABELS_DETAIL_TEXT" => "",
        "CUSTOM_LABELS_DETAIL_PICTURE" => "",
        "CUSTOM_LABELS_PHONE" => "Телефон",
        "POPUP_MODE" => "Y",
    ),
    false
);?>
    </div>
<a onclick="smoothJumpUp(); return false;"><div class="to-top">^</div></a>

</body>
</html>