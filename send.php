<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    $data = array("resp" => "Good", "error" => array());
    header('Content-Type: application/json');

    $name = $_REQUEST['name'];
    $props[PRODUCT_ID] = $_REQUEST['id'];
    $props[EMAIL] = $_REQUEST['email'];
    $props[TEL] = $_REQUEST['tel'];

    $emailAdmin = 'leshkin-95@mail.ru';
    $subjectAdmin = "Новый покупатель";
    $subjectPerson = "Подтверждение заказа";
    $headers = "Content-type: text/html; charset = \"utf-8\".\r\n";
    $headers .= "From: testshop@umgm.ru\r\n";

    CModule::IncludeModule("iblock");
    $res = new CIBlockElement;

    $orderArray = Array(
        "IBLOCK_ID"       => 2,
        "NAME"            => $name,
        "PROPERTY_VALUES" => $props
    );

    $idOrder = $res->Add($orderArray);

    $arFieldsAdmin = array(
        "ID_ORDER"   => $idOrder,
        "USER_NAME"  => $name,
        "TEL"        => $props[TEL],
        "EMAIL_TO"   => $props[EMAIL],
        "PRODUCT_ID" => $props[PRODUCT_ID],
        "VOTE_TITLE" => $subjectAdmin
    );

    CEvent::Send("VOTE_FOR", "s1", $arFieldsAdmin, "N", 33);

    $arFieldsPerson = array(
        "ID_ORDER"    => $idOrder,
        "USER_NAME"   => $name,
        "EMAIL_TO"    => $props[EMAIL],
        "VOTE_TITLE"  => $subjectPerson,
        "EMAIL_ADMIN" => $emailAdmin
    );

    CEvent::Send("VOTE_FOR", "s1", $arFieldsPerson, "N", 36);

    echo json_encode($data);
?>