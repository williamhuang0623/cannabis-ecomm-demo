<?php
ini_set('display_errors', true);
	ini_set('display_startup_errors', true);
	error_reporting(E_ALL);
?>
<!Doctype html>
<html>
<head>
    <title>Assignment 8: Cannabis Cart</title>
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
    <h1>Cannabis Shopping Cart</h1> 
</div>
<?php
    $file = fopen("../info.txt", "r+");
    $output = fopen("../output.txt", "w+");
    
    while (!feof($file)) {
        $line = fgets($file);
        if ($line != "") {
            $array = explode(",", $line);
            $new_line = $array[0] . "," . $array[1] . ",";

            $new_price = $_POST[$array[4] . '_price'];
            $new_stock = $_POST[$array[4] . '_stock'];

            // Check if stock or price has been changed
            if ($new_stock != "") {
                $new_line .= $new_stock . ",";
            } else {
                $new_line .= $array[2] . ",";
            }
            if ($new_price != "") {
                $new_line .= $new_price . ",";
            } else {
                $new_line .= $array[3] . ",";
            }
            $new_line .= $array[4] . "," . "\n";
            fwrite($output, $new_line);
        }
    }
    fclose($file);
    fclose($output);
    
    //writing output file back to original file
    $info_file = fopen("../info.txt", "w");
    $input = fopen("../output.txt", "r");
    while (!feof($input)) {
        $line = fgets($input);
        if ($line != "") {
            fwrite($info_file, $line); 
        }
    }
    fclose($info_file);
    fclose($input);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <h4>Your input has been recorded!</h4>
        <a href="index.php"><button id="button">Go To Shopping Cart</button></a>
        </div>
    </div>
</div>
<footer></footer>
</body>

</html>