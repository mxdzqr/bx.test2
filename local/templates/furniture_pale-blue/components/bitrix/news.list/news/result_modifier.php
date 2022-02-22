<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Iblock\Elements\ElementAdditionalNewsTable;

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

if ($arResult['ITEMS']) {
    $date = date($DB->DateFormatToPHP(CSite::GetDateFormat()), time());
    $arResult['SUB_ITEMS'] = ElementAdditionalNewsTable::getList([
        'filter' => [
            '<ACTIVE_FROM' => $date,
            'ACTIVE' => 'Y'
        ],
        'select' => ['ID', 'NAME', 'PREVIEW_TEXT', 'ACTIVE_FROM'],
        'order' => ['ACTIVE_FROM' => 'DESC'],
        'limit' => 2
    ])->fetchAll();
}
