<?
    $text = $_REQUEST['feed'];
    $name = $_REQUEST['name-person'];
    $text = addslashes($text);
    $name = addslashes($name);
    
    if (isset($_POST['name-person']) && isset($_POST['feed']))
    {    
        $link = mysqli_connect("localhost", "ashakirova_tshop", "QB*H0VDy3234234", "ashakirova_tshop");
        $data = array("resp" => "Good", "error" => " ");
        header('Content-Type: application/json');

        if (!$link)
        {
            $data['resp'] = "Bad";
            $data['error'] = mysqli_connect_error();
            echo json_encode($data);
            exit();
        }

        $res = $link->query("SELECT count(*) FROM reviews");
        $row = $res->fetch_row();
        $id = $row[0];

        $sql = mysqli_query($link, "INSERT INTO `reviews` (`ID`, `feedback`, `name`) VALUE ('{$id}', '{$text}', '{$name}')");
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

        $result->free();
        $mysqli->close(); 
    }
?> 