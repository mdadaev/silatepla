<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Компания теплоконтроль");
?>
    <section class="sect-one white-color">
        <div class="container1-my">
            <h2 data-wow-duration="2s" data-wow-delay="3s" class="h-title sect-one__title wow fadeInDown">
                <?$APPLICATION->IncludeFile(
                    '/includes/index/title.php',
                    array(),
                    array(
                        'MODE' => 'php',
                        'NAME' => 'Заголовок',
                    )
                )?>
            </h2>
            <?$APPLICATION->IncludeFile(
                '/includes/index/benefits.php',
                array(),
                array(
                    'MODE' => 'php',
                    'NAME' => 'Преимущества',
                )
            )?>
            <div class="sect-one__buttons"><a href="#kontakt-f" data-wow-duration="1s" data-wow-delay="3200ms"
                                              class="btn btn_green sect-one__greenbtn js-fan-windows wow fadeInLeft"><b
                        class="sect-one__btn-bold">Узнайте, сколько будет стоить</b>проект Вашей котельной</a>
                <a
                    href="#kontakt-f" data-wow-duration="1s" data-wow-delay="3200ms"
                    class="btn btn_red sect-one__redbtn js-fan-windows wow fadeInRight"><b class="sect-one__btn-bold">Собираетесь
                        строить котельную?</b>Обсудите с нами цену и сроки</a>
            </div>
        </div>
    </section>
<?
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"services", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "999",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "NAME",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "NAME",
			3 => "SORT",
			4 => "PREVIEW_TEXT",
			5 => "PREVIEW_PICTURE",
			6 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "LINK",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "services",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
    <div class="section experience white-color">
        <div class="container1-my">
            <h2 data-wow-delay="500ms" class="h-title we-do__h-title wow fadeInDown">
                <?$APPLICATION->IncludeFile(
                    '/includes/index/experience/title.php',
                    array(),
                    array(
                        'MODE' => 'html',
                        'NAME' => 'Заголовок',
                    )
                )?>
            </h2>

            <h3 data-wow-delay="1000ms" class="h-title3 experience__htitle3 wow fadeInDown">
                <?$APPLICATION->IncludeFile(
                    '/includes/index/experience/subtitle.php',
                    array(),
                    array(
                        'MODE' => 'html',
                        'NAME' => 'Подзаголовок',
                    )
                )?>
            </h3>

            <p data-wow-delay="1500ms" class="wow fadeInDown">
                <?$APPLICATION->IncludeFile(
                    '/includes/index/experience/description.php',
                    array(),
                    array(
                        'MODE' => 'html',
                        'NAME' => 'Описание',
                    )
                )?>
            </p>

            <div class="exp-items">
                <div data-wow-delay="1000ms" data-wow-duration="2s" class="exp-items__circular wow fadeInDown2">
                    <?$APPLICATION->IncludeFile(
                        '/includes/index/experience/data.php',
                        array(),
                        array(
                            'MODE' => 'php',
                            'NAME' => 'Количество',
                        )
                    )?>
                </div>
                <p data-wow-delay="1700ms" class="exp-items__under-round wow fadeIn">
                    <?$APPLICATION->IncludeFile(
                        '/includes/index/experience/data-desc.php',
                        array(),
                        array(
                            'MODE' => 'html',
                            'NAME' => 'Описание',
                        )
                    )?>
                </p>

                <div data-wow-delay="500ms" class="exp-items__species exp-items__species_1MWT wow fadeInLeft">
                    <div class="exp-items__species-white-line MWT1"></div>
                    <?$APPLICATION->IncludeFile(
                        '/includes/index/experience/category-1.php',
                        array(),
                        array(
                            'MODE' => 'php',
                            'NAME' => 'Категория 1',
                        )
                    )?>
                </div>
                <div data-wow-delay="500ms" class="exp-items__species exp-items__species_1-10MWT wow fadeInRight">
                    <div class="exp-items__species-white-line MWT1-10"></div>
                    <?$APPLICATION->IncludeFile(
                        '/includes/index/experience/category-2.php',
                        array(),
                        array(
                            'MODE' => 'php',
                            'NAME' => 'Категория 2',
                        )
                    )?>
                </div>
                <div data-wow-delay="900ms" class="exp-items__species exp-items__species_10-25MWT wow fadeInLeft">
                    <div class="exp-items__species-white-line MWT10-25MWT"></div>
                    <?$APPLICATION->IncludeFile(
                        '/includes/index/experience/category-3.php',
                        array(),
                        array(
                            'MODE' => 'php',
                            'NAME' => 'Категория 3',
                        )
                    )?>
                </div>
                <div data-wow-delay="900ms" class="exp-items__species exp-items__species_more25MWT wow fadeInRight">
                    <div class="exp-items__species-white-line more25MWT"></div>
                    <?$APPLICATION->IncludeFile(
                        '/includes/index/experience/category-4.php',
                        array(),
                        array(
                            'MODE' => 'php',
                            'NAME' => 'Категория 4',
                        )
                    )?>
                </div>
                <a href="#kontakt-f" data-wow-delay="1300ms"
                   class="btn btn_red sect-one__redbtn exp-items__btn_red js-fan-windows wow fadeIn">
                    <b class="sect-one__btn-bold">свяжитесь с нами и мы вместе решим</b>какую часть диаграммы может
                    дополнить Ваша котельная
                </a>
            </div>
        </div>
    </div>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "our-work",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "2",
        "NEWS_COUNT" => "5",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "NAME",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(
            0 => "ID",
            1 => "NAME",
            2 => "SORT",
            3 => "PREVIEW_TEXT",
        ),
        "PROPERTY_CODE" => array(
            0 => "SVG",
            1 => "",
        ),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
);?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "docs",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "4",
        "NEWS_COUNT" => "9999",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "NAME",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(
            0 => "ID",
            1 => "NAME",
            2 => "SORT",
            3 => "PREVIEW_TEXT",
            4 => "PREVIEW_PICTURE",
            5 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "LINK",
            1 => "",
        ),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
);?>
    <div class="section partners">
        <div class="container1-my">
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "partners",
                array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => "3",
                    "NEWS_COUNT" => "9999",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "NAME",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(
                        0 => "ID",
                        1 => "NAME",
                        2 => "SORT",
                        3 => "PREVIEW_TEXT",
                        4 => "PREVIEW_PICTURE",
                        5 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "LINK",
                        1 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED" => "Y",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => "",
                    "PAGER_BASE_LINK" => "",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "TITLE" => "Наши партнеры",
                    "SECTION" => "COMPANY"
                ),
                false
            );?>
        </div>
    </div>

    <div class="page__buffer"></div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>