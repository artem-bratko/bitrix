<?
/* Модификация (изменение) H1 заголовка элемента каталога*/
/************НАЧАЛО*****************/

//получаем все категории к которым привязан текущий элемент
$db_old_groups = CIBlockElement::GetElementGroups($arResult['ID'], true);
$ar_new_groups = Array();
while($ar_group = $db_old_groups->Fetch())
$ar_new_groups[] = $ar_group["NAME"];

//ищем нужные категории и записываем новые названия для H1 заголовка
if(in_array("Пассажирские лифты", $ar_new_groups)){
	$ar_new_groups['NEW_GROUP_LIFT'] = 'Пассажирский лифт';
}
if(in_array("Пассажирские лифты", $ar_new_groups) && in_array("Грузовые лифты", $ar_new_groups)){
	$ar_new_groups['NEW_GROUP_LIFT'] = 'Грузопассажирский лифт';
}

//чтобы при включенном кеше изменение заголовка стало возможным, пишем код:
$cp = $this->__component; // объект компонента
if (is_object($cp))
{
    // добавим в arResult компонента поле - PAGE_H1 и положим в него новый сформированный H1
    $cp->arResult['PAGE_H1'] = $ar_new_groups["NEW_GROUP_LIFT"] . ' ' . $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"];
    $cp->SetResultCacheKeys(array('PAGE_H1'));
}

//дальше уже в component_epilog.php устанавливаем новый заголовок $APPLICATION->SetTitle($arResult['PAGE_H1']);
/************КОНЕЦ******************/