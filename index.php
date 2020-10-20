<!DOCTYPE html>

<html lang = "ru">

<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <link rel = "stylesheet" href = "/style.css?v=1">
    <title>TestShop</title>
</head>

<body>
    <div class = "wrapper">

	    <input type = "radio" name = "point" id = "slide1" checked>
	    <input type = "radio" name = "point" id = "slide2">
	    <input type = "radio" name = "point" id = "slide3">
	    <input type = "radio" name = "point" id = "slide4">
	    <input type = "radio" name = "point" id = "slide5">
        
        <div class = "slider">
		    <div class = "slides slide1"></div>
		    <div class = "slides slide2"></div>
		    <div class = "slides slide3"></div>
		    <div class = "slides slide4"></div>
		    <div class = "slides slide5"></div>
	    </div>	
        
        <div class = "controls">
		    <label for = "slide1"></label>
		    <label for = "slide2"></label>
		    <label for = "slide3"></label>
		    <label for = "slide4"></label>
		    <label for = "slide5"></label>
	    </div>
    
    </div>

    <?php
    require 'scripts/connect.php';
    $sql_select = "SELECT * FROM sales";
    $result = mysql_query($sql_select);
    $row = mysql_fetch_array($result);
    do
    {
	    printf("<p>Товар: " .$row['first_name'] . " " .$row['last_name'] ."</p> 
	<p><i>Контактные данные</i></p><p>E-mail: " .$row['email'] . "</p><p>Facebook: " .$row['facebook'] . "</p>---------<br/>"
	);
}
while($row = mysql_fetch_array($result));
         ?>

</body>

</html>