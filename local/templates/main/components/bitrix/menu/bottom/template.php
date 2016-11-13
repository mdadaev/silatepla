<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

if (empty($arResult)) {
	return;
}

use Esta\Main\Util;

$showLevel = function($node) use ($arParams, &$showLevel) {
	if ($node['DEPTH_LEVEL'] > $arParams['MAX_LEVEL']) {
		return;
	}
	
	foreach($node['CHILDREN'] as $item) {
		$isBlank = strpos($item['LINK'], '//') !== false;
		?>
        <li class="footer__list-item">
            <a href="<?=$item['LINK']?>" class="footer__list-link">
                <svg class="footer__list-pic" width="13.66px" height="10px">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/svg-symbolsfrhx4leg66r.svg#red-arrow"></use>
                </svg>
                <?=$item['TEXT']?>
            </a>
        </li>
		<?
		$showLevel($item);
	}
};
?>

<ul class="footer__list">
		<?$showLevel(Util::menuToTree($arResult))?>
</ul>
