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
        <a data-wow-duration="1s" data-wow-delay="<?=$item['PARAMS']['DELAY']?>"  href="<?=$item['LINK']?>" class="top-menu__item wow fadeInDown">
            <?=$item['TEXT']?>
        </a>
		<?
		$showLevel($item);
	}
};
?>

<nav class="top-menu mob-hide">
		<?$showLevel(Util::menuToTree($arResult))?>
</nav>
