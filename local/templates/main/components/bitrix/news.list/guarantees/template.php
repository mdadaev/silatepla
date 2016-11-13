<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!$arResult['ITEMS']) {
    return;
}
?>

<section class="garanty-sec we-do main-pad_padtopno white-color">
    <div class="container1-my">
        <h2 class="h-title we-do__h-title wow fadeInDown"><?= $arParams["TITLE"] ?></h2>

        <div class="garanty-sec__minititle wow fadeInDown">стандартные сроки гарантии составляют</div>
        <div class="garanty-sec__flwrap">
            <?
            if ($arParams['DISPLAY_TOP_PAGER']) {
                print $arResult['NAV_STRING'];
            }

            foreach ($arResult['ITEMS'] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                $showLink = !$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS']);
                ?>
                <div class="garanty-sec__half" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                    <div data-wow-delay="500ms" class="exp-items__species wow fadeInLeft">
                        <p class="exp-items__species-text2"><?= $arItem['NAME'] ?></p>

                        <div class="exp-items__redline"></div>
                        <p class="exp-items__species-text"><?= $arItem['PROPERTIES']["TIME"]["VALUE"] ?></p>
                    </div>
                </div>

            <?
            }

            if ($arParams['DISPLAY_BOTTOM_PAGER']) {
                print $arResult['NAV_STRING'];
            }
            ?>
        </div>
        <?= $arResult["DESCRIPTION"] ?>
        <div class="projects__center-btn">
            <a href="#build_comments" data-wow-delay="1200ms"
               class="btn btn_red sect-one__redbtn js-fan-windows wow fadeInDown">
                <b class="sect-one__btn-bold">Посмотрите комментарий </b>по поводу срока гарантии
            </a>
            <div style="display: none">
                <div id="build_comments" class="text-popup">
                    <p>
                        Увеличение срока гарантии - это не трюк, а простой здравый смысл.
                        Технически сложный объект должен обслуживаться знающими людьми, обладающими необходимым опытом, аттестациями, вооруженными диагностическим оборудованием. За редкими исключениями, служба эксплуатации такую работу выполнить неспособна.
                    </p>
                    <p>
                        Вот пример из жизни: иномарка без проблем ездит пару сотен тысяч или больше. Причина не только в качестве изделия, но и в том, что хозяин поневоле должен проходить квалифицированное ТО в авторизованном техцентре.
                        С нашими котельными же сплошь и рядом происходит следующее: убедившись, что котельная успешно работает <b>без всякого вмешательства персонала</b>, Заказчик решает обойтись без ее квалифицированного технического обслуживания. А ведь котельная ничуть не проще автомобиля, и уж точно не дешевле…
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
