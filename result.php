<?
    $text = $_REQUEST['feed'];
    $name = $_REQUEST['name-person'];

    $options = array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $db = new PDO('mysql:host=localhost; dbname=ashakirova_tshop; charset=utf8', "ashakirova_tshop", "QB*H0VDy3234234",$options);
    $data = array("resp" => "Good", "error" => " ");
    header('Content-Type: application/json');

    if (!$db)
    {
        $data['resp'] = "Bad";
        $data['error'] = "No Connection DB";
        echo json_encode($data);
        exit();
    }

    $sql = $db->prepare("INSERT INTO reviews (feedback, name) VALUES (:text, :name)");
    $sql->execute( array( ':text' => $text, ':name' => $name ) );

    if (!$sql)
    {
        $data['resp'] = "Bad";
        $data['error'] = $db->errorInfo();
    }

    echo json_encode($data);

    $db = null; 
?> 