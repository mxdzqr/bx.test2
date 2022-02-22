<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<?php if ($arResult): ?>
    <div class="news-list">
        <?php if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?><br />
        <?php endif;?>

        <?php foreach($arResult["ITEMS"] as $arItem):?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="news-item-good" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                <?php if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                    <div class="news-date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
                <?php endif ?>
                <?php if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                    <?php if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><b><?= $arItem["NAME"] ?></b></a><br/>
                    <?php
                    else: ?>
                        <div class="news-title"><?= $arItem["NAME"] ?></div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]):?>
                    <div class="news-detail"><?= $arItem["PREVIEW_TEXT"] ?></div>
                <?php endif;?>
            </div>
        <?php endforeach;?>

        <?php if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br /><?=$arResult["NAV_STRING"]?>
        <?php endif;?>

        <?php if ($arResult["SUB_ITEMS"]): ?>
            <?php foreach($arResult["SUB_ITEMS"] as $arSubItem):?>
                <div class="news-item-good">
                    <?php if ($arParams["DISPLAY_DATE"] != "N" && $arSubItem["ACTIVE_FROM"]): ?>
                        <div class="news-date"><?= $arSubItem["ACTIVE_FROM"] ?></div>
                    <?php endif ?>
                    <?php if ($arParams["DISPLAY_NAME"] != "N" && $arSubItem["NAME"]): ?>
                        <?php if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                            <a href="<?= $arSubItem["DETAIL_PAGE_URL"] ?>"><b><?= $arSubItem["NAME"] ?></b></a><br/>
                        <?php else: ?>
                            <div class="news-title"><?= $arSubItem["NAME"] ?></div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arSubItem["PREVIEW_TEXT"]):?>
                        <div class="news-detail"><?= $arSubItem["PREVIEW_TEXT"] ?></div>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
<?php endif; ?>