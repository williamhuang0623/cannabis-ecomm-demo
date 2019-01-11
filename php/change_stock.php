<?php
ini_set('display_errors', true);
	ini_set('display_startup_errors', true);
	error_reporting(E_ALL);
?>
<!Doctype html>
<html>
<head>
    <title>Assignment 8: Inventory Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="shopping.css" rel="stylesheet" type="text/css">
</head>
    
<body>
<header>
    <img src="../img/logo.png">
</header>
<div class="jumbotron">
    <h1>Merchant Side: Update Inventory</h1> 
</div>
<div class="container">
    <form method="post" action="change_txt.php">
    <?php
    $file = fopen("../info.txt", "r+");
    $counter = 0;
    while(!feof($file)) {
        $line = fgets($file);
        if ($line != "") {
            if ($counter%4 == 0) {
                echo "<div class='row'>";
            }

            $array = explode(",", $line);
            echo "<div class='col-sm-3'>";
            echo "<h4>" . $array[0] . "</h4>";
            if ((int)$array[2] == 0) {
                echo "<img src='../img/outofstock.jpg' class='row-image'>";
            } else {
                echo "<img src='../img/" . $array[1] . "' class='row-image'>";
            }
            echo "<p> Current Stock: " . $array[2] . "</p>";
            echo "<input type='text' name='" . $array[4] . "_stock' class='textinput'>";
            echo "<p> Current Price: $" . $array[3] . "</p>";
            echo "<input type='text' name='" . $array[4] . "_price' class='textinput'>";
            echo "</div>";

            if ($counter%4 == 3) {
                echo "</div>";
            }
            $counter++;    
            }
        }
    echo "<input type='submit' name='submit' value='Submit' class='submit'>";
    fclose($file);
    ?>
    </form>
    </div>
<footer></footer>
</body>

</html>