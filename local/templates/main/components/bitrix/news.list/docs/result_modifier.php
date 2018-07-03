<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y",
);
if (intval($arParams["PARENT_SECTION"]) > 0) {
    $rsSect = CIBlockSection::GetByID($arParams["PARENT_SECTION"]);
    if ($arSect = $rsSect->Fetch()) {
        $arFilter["LEFT_MARGIN"] = $arSect["LEFT_MARGIN"];
        $arFilter["RIGHT_MARGIN"] = $arSect["RIGHT_MARGIN"];
    }
}

$rsSection = CIBlockSection::GetList(
    array("LEFT_MARGIN" => "ASC"),
    $arFilter,
    false,
    array("ID", "NAME", "SORT", "DEPTH_LEVEL"),
    false);

$previousDepthLevel = 1;
$previousID = false;
while ($arSection = $rsSection->GetNext()) {
    $arResult["SECTIONS"][$arSection["ID"]] = $arSection;

    if ($previousID) {
        $arResult["SECTIONS"][$previousID]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;
    }

    $previousDepthLevel = $arSection["DEPTH_LEVEL"];
    $previousID = $arSection["ID"];
}

foreach ($arResult["ITEMS"] as $arItem) {
    $arResult["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["ITEMS"][] = $arItem;
}
?>