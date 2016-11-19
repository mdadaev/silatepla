<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Компания теплоконтроль");
?>
    <section class="sect-one sect-one_build white-color">
        <div class="container1-my">
            <h2 data-wow-duration="2s" data-wow-delay="3s" class="h-title sect-one__title wow fadeInDown">
                <?$APPLICATION->IncludeFile(
                    '/includes/build/title.php',
                    array(),
                    array(
                        'MODE' => 'php',
                        'NAME' => 'Заголовок',
                    )
                )?>
            </h2>
            <ul class="sect-one__list sect-one__list_margbot">
                <li data-wow-duration="1s" data-wow-delay="3200ms"
                    class="sect-one__list-item sect-one__list-item_flwrap wow fadeInLeft">
                    <svg class="sect-one__chek-pic sect-one__chek-pic_manu" width="44px" height="43px">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg-symbolsu29rl4bo6r.svg#checkmark"></use>
                    </svg>
                    <?$APPLICATION->IncludeFile(
                        '/includes/build/control.php',
                        array(),
                        array(
                            'MODE' => 'html',
                            'NAME' => 'Контроль текст 1',
                        )
                    )?>
                    <p class="sect-one_manufacture__mintext">
                        <?$APPLICATION->IncludeFile(
                            '/includes/build/control-sub.php',
                            array(),
                            array(
                                'MODE' => 'html',
                                'NAME' => 'Контроль текст 2',
                            )
                        )?>

                    </p>
                </li>
            </ul>
            <div class="sect-one__buttons">
                <a href="#kontakt-f" data-wow-duration="1s" data-wow-delay="3200ms"
                   class="btn btn_green sect-one__greenbtn js-fan-windows wow fadeInLeft">
                    <b class="sect-one__btn-bold">узнайте стоимость </b>Вашей котельной
                </a>
                <a href="#kontakt-f" data-wow-duration="1s" data-wow-delay="3200ms"
                   class="btn btn_red sect-one__redbtn js-fan-windows wow fadeInRight">
                    <b class="sect-one__btn-bold">задайте интересующие Вас вопросы </b>по организации работ
                </a>
            </div>
        </div>
    </section>
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
                    "IBLOCK_ID" => "7",
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
                    "TITLE" => "Наши заказчики"
                ),
                false
            );?>
        </div>
    </div>
    <section class="section build-withkey white-color">
        <div class="container1-my">
            <h2 data-wow-delay="500ms" class="h-title h-title_hard-quest wow fadeInDown">Нашe производство</h2>
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "simple-list",
                array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => "8",
                    "NEWS_COUNT" => "9999",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "NAME",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(
                        0 => "ID",
                        1 => "NAME",
                    ),
                    "PROPERTY_CODE" => array(),
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
                    "PARENT_SECTION_CODE" => "build",
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
                    "TITLE" => "Нашe производство"
                ),
                false
            );?>
            <div class="projects__center-btn"><a href="#kontakt-f" data-wow-delay="1700ms"
                                                 class="btn btn_red sect-one__redbtn js-fan-windows wow fadeInDown"><b
                        class="sect-one__btn-bold">узнайте, какой тип котельной </b>подходит для Вашей задачи </a>
            </div>
        </div>
    </section>
    <section class="build-time-sec">
        <div class="container1-my">
            <h2 class="h-title we-do__h-title wow fadeInDown">Сроки строительства</h2>

            <div class="row we-do__block between-sm">
                <div data-wow-delay="500ms" class="we-do__col-left_build wow fadeInLeft">
                    <div class="green-bord">

                        <?$APPLICATION->IncludeFile(
                            '/includes/build/times-picture.php',
                            array(),
                            array(
                                'MODE' => 'php',
                                'NAME' => 'Изображение'
                            )
                        )?>

                    </div>
                </div>
                <div data-wow-delay="500ms" class="we-do__col-right_build wow fadeInRight">

                    <p class="text">
                        <b>
                            <?$APPLICATION->IncludeFile(
                                '/includes/build/times-title.php',
                                array(),
                                array(
                                    'MODE' => 'html',
                                    'NAME' => 'Сроки - заголовок'
                                )
                            )?>
                        </b>
                    </p>

                    <p class="text">
                        <?$APPLICATION->IncludeFile(
                            '/includes/build/times-text.php',
                            array(),
                            array(
                                'MODE' => 'html',
                                'NAME' => 'Сроки - текст'
                            )
                        )?>
                    </p>

                    <div class="reviews__minired-line reviews__minired-line_marg"></div>
                    <p class="text">
                        <?$APPLICATION->IncludeFile(
                            '/includes/build/times-text2.php',
                            array(),
                            array(
                                'MODE' => 'php',
                                'NAME' => 'Сроки - текст2',
                            )
                        )?>
                    </p>

                </div>
            </div>
            <div class="projects__center-btn">
                <a href="#kontakt-f" data-wow-delay="1700ms"
                   class="btn btn_red sect-one__redbtn js-fan-windows wow fadeInDown">
                    <b class="sect-one__btn-bold">Проконсультируйтесь по срокам строительства </b>Вашей котельной
                </a>

                <p>
                    <br>
                </p>

                <p data-wow-delay="1800ms" class="wow fadeInDown">
                    <?$APPLICATION->IncludeFile(
                        '/includes/build/times-text-second.php',
                        array(),
                        array(
                            'MODE' => 'html',
                            'NAME' => 'Сроки - текст дополнительный',
                        )
                    )?>
                </p>
            </div>
            <!--.row.we-do__block.between-sm-->
        </div>
    </section>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "guarantees",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "9",
        "NEWS_COUNT" => "9999",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "NAME",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(
            0 => "ID",
            1 => "NAME",
        ),
        "PROPERTY_CODE" => array("TIME"),
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
        "TITLE" => "Наши гарантии"
    ),
    false
);?>
    <section class="main-pad we-do main-pad_padtopno">
        <div class="container1-my">
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "projects",
                array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => "11",
                    "NEWS_COUNT" => "9999",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "NAME",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(
                        0 => "DETAIL_PICTURE",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "PARAMETRS",
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
                    "COMPONENT_TEMPLATE" => "projects",
                    "TITLE" => "Примеры наших проектов",
                    "PREVIEW_PICTURE_W" => "550",
                    "PREVIEW_PICTURE_H" => "350"
                ),
                false
            );?>
        </div>
    </section>

    <section class="reviews-sec">
        <div class="container1-my">
            <div class="redbord-top redbord-top_inreviews"></div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "reviews",
                array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => "10",
                    "NEWS_COUNT" => "9999",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "NAME",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(
                        0 => "ID",
                        1 => "NAME",
                    ),
                    "PROPERTY_CODE" => array("AUTHOR", "COMPANY"),
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
                    "TITLE" => "Отзывы"
                ),
                false
            );?>
        </div>
    </section>
    <div class="page__buffer"></div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>