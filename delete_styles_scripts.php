<?php
AddEventHandler("main", "OnEndBufferContent", "deleteUndue");

function deleteUndue(&$content) {
    global $APPLICATION;
    if (strpos($APPLICATION->GetCurDir(), "/bitrix/") !== false) {
        return;
    }

    $arPatternsToRemove = Array(
        //Убираем лишние скрипты битрикса*/
        '/<script.+?src=".+?bitrix\/js\/main\/core\/core[^"]+"><\/script\>/',
        '/<script.+?>BX\.(setCSSList|setJSList)\(\[.+?\]\).*?<\/script>/',
        '/<script.+?src=".+?loadext[\w\d_\.\/]+\.js\?\d+"><\/script\>/',
        '/<script[^>]+?>.+?bx-core.+?<\/script>/',
        '/<script.+?src=".+?kernel_main[\w\d_\-\/]+\.js\?\d+"><\/script\>/',
        '/<script.+?>if\(\!window\.BX\)window\.BX.+?<\/script>/',
        '/<script[^>]+?>\(window\.BX\|\|top\.BX\)\.message[^<]+<\/script>/',
        //Убираем лишние стили битрикса
        '/<link.+?href=".+?kernel_main\/kernel_main_v1\.css\?\d+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/js\/main\/core\/css\/core[^"]+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/js\/ui\/fonts\/opensans\/ui\.font\.opensans\.min\.css\?\d+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/styles.css[^"]+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/template_styles.css[^"]+"[^>]+>/',
    );

    $content = preg_replace($arPatternsToRemove, "", $content);
}