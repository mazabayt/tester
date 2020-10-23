<?
    $text = $_REQUEST['feed'];
    $name = $_REQUEST['name-person'];
    
    if (isset($_POST['name-person']) && isset($_POST['feed']))
    {    
        $link = mysqli_connect("localhost", "ashakirova_tshop", "QB*H0VDy3234234", "ashakirova_tshop");
        $data = array("resp" => "Good", "error" => " ");
        header('Content-Type: application/json');

        $textReal = $link->real_escape_string($text);
        $nameReal = $link->real_escape_string($name);

        if (!$link)
        {
            $data['resp'] = "Bad";
            $data['error'] = mysqli_connect_error();
            echo json_encode($data);
            exit();
        }

        $sql = mysqli_query($link, "INSERT INTO `reviews` (`feedback`, `name`) VALUE ('{$textReal}', '{$nameReal}')");
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