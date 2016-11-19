<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (defined('\Esta\Main\IS_AJAX') && \Esta\Main\IS_AJAX) {
    return;
}

IncludeTemplateLangFile(__FILE__);

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/separate-js/svg4everybody.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/mainu29rl4bo6r.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/separate-js/fotorama.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/separate-js/jquery.maskedinput.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/esta.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/template.js');

/* Add additional stylesheets */
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/separate-css/flexboxgrid.min.css');

?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta content="telephone=no" name="format-detection">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=cyrillic"
          rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="/fav.ico">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <? $APPLICATION->ShowHead() ?>

</head>
<body role="document">
<? $APPLICATION->ShowPanel() ?>

<section class="page__wrapper">
    <header class="header container1-my">
        <div class="row header__row middle-xs">
            <div data-wow-duration="2s" data-wow-delay="1s" class="col-xs-12 col-sm-5 wow fadeInDown">
                <div class="logo">
                    <h1 class="header__hide-maintitle">
                        <?$APPLICATION->IncludeFile(
                            '/includes/logo-text.php',
                            array(),
                            array(
                                'MODE' => 'html',
                                'NAME' => 'Лого текст',
                            )
                        )?>
                    </h1>
                    <a href="/" class="logo__link">
                        <?$APPLICATION->IncludeFile(
                            '/includes/logo-image.php',
                            array(),
                            array(
                                'MODE' => 'html',
                                'NAME' => 'Логотип',
                            )
                        )?>
                    </a>
                </div>
                <p class="header__logotext">
                    <?$APPLICATION->IncludeFile(
                        '/includes/logo-description.php',
                        array(),
                        array(
                            'MODE' => 'html',
                            'NAME' => 'Логотип описание',
                        )
                    )?>
                </p>
            </div>
            <div class="col-xs-12 col-sm-7 header__text-right header__mob-contacts">
                <?$APPLICATION->IncludeFile(
                    '/includes/header-email.php',
                    array(),
                    array(
                        'MODE' => 'php',
                        'NAME' => 'email',
                    )
                )?>

                <a href="tel:<?= tplvar('pnone');?>" data-wow-duration="2s" data-wow-delay="1400ms"
                   class="header__vecpic wow fadeInDown">
                    <svg class="header__pic-svg" width="15px" height="15px">
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg-symbolsfrhx4leg66r.svg#phone"></use>
                    </svg>
                    <?= tplvar('phone-view');?></a>
                <a href="#zvon" data-wow-duration="2s" data-wow-delay="1600ms"
                                        class="btn btn_green header__btn mob-hide js-fan-windows wow fadeInDown">Обратный
                    звонок</a>
            </div>
        </div>
        <div class="bordrer-nav"></div>
        <div class="row">
            <div class="col-xs-6 col-sm-8">
                <div id="show-nav" class="header__show-nav pc-hide">
                    <svg class="show-nav-picsvg" width="17.157px" height="17.157px">
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg-symbolsfrhx4leg66r.svg#menu"></use>
                    </svg>

                </div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top",
                    Array(
                        "ROOT_MENU_TYPE" => "top",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "top",
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
            <div class="col-xs-6 col-sm-3 col-sm-offset-1 header__text-right">
                <a href="#zvon" class="btn btn_green btn_mini-mob pc-hide js-fan-windows">
                    <svg class="btn_mini-picsvg" width="15px" height="15px">
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg-symbolsfrhx4leg66r.svg#phone"></use>
                    </svg>
                </a>
                <a href="#zvon" class="btn btn_red btn_mini-mob btn_nomarg pc-hide js-fan-windows">
                    <svg class="btn_mini-picsvg" width="18px" height="14px">
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg-symbolsfrhx4leg66r.svg#mail"></use>
                    </svg>
                </a><a href="#kontakt-f" data-wow-duration="1s" data-wow-delay="2600ms"
                       class="btn btn_red header__btn header__btn_red mob-hide js-fan-windows wow fadeInDown">Свяжитесь
                    с нами</a>
            </div>
        </div>
    </header>
    <!--header -->