<?
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $tel = $_REQUEST['tel'];
    $id = $_REQUEST['id'];

    $emailAdmin = 'leshkin-95@mail.ru';
    $subjectAdmin = "Новый покупатель";
    $subjectPerson = "Подтверждение заказа";
    $headers = "Content-type: text/html; charset = \"utf-8\".\r\n";
    $headers .= "From: testshop@umgm.ru\r\n";

    $link = mysqli_connect("localhost", "ashakirova_tshop", "QB*H0VDy3234234", "ashakirova_tshop");

    $nameReal = $link->real_escape_string($name);
    $emalReal = $link->real_escape_string($email);
    $telReal = $link->real_escape_string($tel);

    $data = array("resp" => "Good", "error" => " ");
    header('Content-Type: application/json');

    if (!$link)
    {
        $data['resp'] = "Bad";
        $data['error'] = mysqli_connect_error();
        echo json_encode($data);
        exit();
    }

    $res = $link->query("SELECT count(*) FROM orders");
    $row = $res->fetch_row();
    $idOrder = $row[0] + 1;

    $sql = mysqli_query($link, "INSERT INTO `orders` (`ID`, `name`, `email`, `tel`, `id_sale`) VALUE ('{$idOrder}', '{$nameReal}', '{$emailReal}', '{$telReal}', '{$id}')");
    if ($sql)
    {
        echo json_encode($data);
    }
    else
    {
        $data['resp'] = "Bad";
        $data['error'] = mysqli_error($link);
        echo json_encode($data);
    }

    $messageAdmin = '
        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv = "Content-Type" content = "text/html; charset = utf-8" />
                <title>Message for admin</title>
            </head>

            <body>
                <table bgcolor = "#7c4199" border = "1" cellpadding = "1" cellspacing = "1" style = "margin: 0; padding: 0" width = "100%; max-width: 600px">
                    <tr>
                        <td style = "margin: 10px;">
                            <span style = "display: inline-block; width: 100%; text-align: center; font-size: 25px; margin-top: 5px;">
                                Поступил новый заказ №'.$idOrder.'
                            </span>
                            <span style = "display: inline-block; width: 100%; margin-top: 10px;">
                                С сайта: <a href = "testshop.umgm.ru">testshop.umgm.ru</a>.
                            </span>
                            <span style = "display: inline-block; width: 100%;">
                                Имя клиента: '.htmlentities($name).'
                            </span>
                            <span style = "display: inline-block; width: 100%;">
                                Телефон клиента: '.htmlentities($tel).'
                            </span>
                            <span style = "display: inline-block; width: 100%;">
                                E-mail клиента: <a href = "'.$email.'">'.htmlentities($email).'</a>
                            </span>
                            <span style = "display: inline-block; width: 100%;">
                                id товара: '.$id.'
                            </span>
                        </td>
                    </tr>
                </table>
            </body>
        </html>
    ';

    $messagePerson = '
        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv = "Content-Type" content = "text/html; charset = utf-8" />
                <title>Message for person</title>
            </head>

            <body>
                <table bgcolor = "#7c4199" border = "0" cellpadding = "1" cellspacing = "1" style = "margin: 0; padding: 0" width = "100%; max-width: 600px">
                    <tr>
                        <td>
                            <span style = "display: inline-block; width: 100%; text-align: center; font-size: 25px; margin-top: 5px;">
                                Спасибо за покупку
                            </span>
                            <span style = "display: inline-block; width: 100%; margin-top: 10px;">
                                Здравствуйте, '.htmlentities($name).', вы совершили заказ на сайте <a href = "testshop.umgm.ru">testshop.umgm.ru</a>. Номер вашего заказа: "'.$idOrder.'"
                            </span>
                            <span style = "display: inline-block; width: 100%;">
                                В течении суток наш менеджер свяжется по указанному вами телефону
                            </span>
                            <span style = "display: inline-block; width: 100%;">
                                По всем вопросам пишите администратору: '.$emailAdmin.'
                            </span>
                            <span style = "display: inline-block; width: 100%;">
                                Благодарим, что выбрали нас
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style = "background-color: black; color: white;">
                            <span style = "display: inline-block; width: 100%; margin: 5px;">
                                Это автоматическое письмо, не надо на него отвечать. Если вы получили его по ошибке, просто игнорируйте
                            </span>
                        </td>
                    </tr>
                </table>
            </body>
        </html>
    ';

    mail($email, $subjectPerson, $messagePerson, $headers);
    mail($emailAdmin, $subjectAdmin, $messageAdmin, $headers);

    $result->free();
    $mysqli->close(); 

?>