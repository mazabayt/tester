<?
    $text = $_REQUEST['feed'];
    $name = $_REQUEST['name-person'];
    
    if (isset($_POST['name-person']) && isset($_POST['feed']))
    {    
        $link = mysqli_connect("localhost", "ashakirova_tshop", "QB*H0VDy3234234", "ashakirova_tshop");

        if (!$link)
        {
            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
            exit();
        }

        $res = $link->query("SELECT count(*) FROM reviews");
        $row = $res->fetch_row();
        $id = $row[0];

        $sql = mysqli_query($link, "INSERT INTO `reviews` (`ID`, `feedback`, `name`) VALUE ('{$id}', '{$text}', '{$name}')");
        if ($sql)
        {
            echo '<p>Good</p>';
        }
        else
        {
            echo '<p>Error!!!!!!' . mysqli_error($link) . '</p>';
        }

        $result->free();
        $mysqli->close(); 
    }
?> 