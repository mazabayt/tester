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

    $options = array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $db = new PDO('mysql:host=localhost; dbname=ashakirova_tshop; charset=utf8', "ashakirova_tshop", "QB*H0VDy3234234", $options);

    if (!$db)
    {
        $data['resp'] = "Bad";
        $data['error'][] = "No Connection DB";
        echo json_encode($data);
        exit();
    }

    $sql = $db->prepare("INSERT INTO orders (name, email, tel, id_sale) VALUES (:name, :email, :tel, :id)");
    $sql->execute( array( ':name' => $name, ':email' => $email, ':tel' => $tel, ':id' => $id ) );

    $data = array("resp" => "Good", "error" => array());
    header('Content-Type: application/json');

    $idOrder = $db->insert_id;

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
                                E-mail клиента: <a href = "'.htmlentities($email).'">'.htmlentities($email).'</a>
                            </span>
                            <span style = "display: inline-block; width: 100%;">
                                id товара: '.htmlentities($id).'
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

    if (!mail($email, $subjectPerson, $messagePerson, $headers))
    {
        $data['resp'] = "Bad";
        $data['error'][] = error_get_last()['message'];
    }

    if (!mail($emailAdmin, $subjectAdmin, $messageAdmin, $headers))
    {
        $data['resp'] = "Bad";
        $data['error'][] = error_get_last()['message'];
    }

    if (!$sql)
    {
        $data['resp'] = "Bad";
        $data['error'][] = $db->errorInfo();
    }

    echo json_encode($data);

    $db = null; 

?>