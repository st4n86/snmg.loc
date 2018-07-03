<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$previousLevel = 0;
?>
<?if(count($arResult["SECTIONS"])):?>
    <ul>

        <?foreach($arResult["SECTIONS"] as $arSection):?>

            <?if ($previousLevel && $arSection["DEPTH_LEVEL"] < $previousLevel):?>
                <?=str_repeat("</ul></li>", ($previousLevel - $arSection["DEPTH_LEVEL"]));?>
            <?endif?>

            <li>
                <h2><?=$arSection["NAME"]?></h2>
                <?if(count($arSection["ITEMS"])):?>
                    <div class="row">
                        <?foreach($arSection["ITEMS"] as $arItem):?>
                            <div class="col-3">
                                <h4><?=$arItem["NAME"]?></h4>
                                <?if($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]):?>
                                    <span><?=substr(strrchr($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["FILE_NAME"], '.'), 1);?></span>
                                    <i><?=round($arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["FILE_SIZE"]/1024)?> KB</i>
                                <?endif?>
                            </div>
                        <?endforeach;?>
                    </div>
                <?endif;?>
                <?if($arSection["IS_PARENT"]):?>
                    <ul>
                <?else:?>
                    </li>
                <?endif;?>

            <?$previousLevel = $arSection["DEPTH_LEVEL"];?>

        <?endforeach;?>

        <?if ($previousLevel > 1):?>
            <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
        <?endif?>

    </ul>
<?endif?>