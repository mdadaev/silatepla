<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Esta\Main\Iblock\Content\Services;
use Esta\Main\Iblock\Content\Specialists;

//Получаем услуги
$cServices = Services::getInstance();
$arFilterServices = array("ACTIVE" => "Y", "IBLOCK_ID" => $cServices->getId());
if ($arParams["SECTION_CODE"]) {
    $arFilterServices["SECTION_CODE"] = $arParams["SECTION_CODE"];
}
$arServices = $cServices->getElementsData(
    array(),
    $arFilterServices,
    false,
    false,
    array("ID", "NAME")
);
$arResult["SERVICES"] = $arServices;
foreach ($arServices as $arService) {
    $arServicesId[] = $arService["ID"];
}
//Получаем специалистов
$cSpecialists = Specialists::getInstance();
$arFilterSpecialists = array("ACTIVE" => "Y", "IBLOCK_ID" => $cSpecialists->getId(), "PROPERTY_SERVICE" => $arServicesId);

$arSpecialists = $cSpecialists->getElementsData(
    array(),
    $arFilterSpecialists,
    false,
    false,
    array("ID", "NAME", "IBLOCK_ID")
);
$arResult["SPECIALISTS"] = $arSpecialists;

?>