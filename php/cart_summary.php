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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
    
<body>
<header>
    <img src="../img/logo.png">
</header>
<div class="jumbotron">
    <h1>Cart Summary</h1> 
</div>
<h2 id="welcome"></h2>
    
<div class="container">
    <h2 id="welcome"></h2>
    <h2>Here is your total - Please click Confirm to check out.</h2>
    <form method="POST" action="checkout.php">
        <table>
        <tr>
            <th>Picture</th>
            <th>Item</th>
            <th>Price</th>
        </tr>
        <?php
        $sum = 0;
        $counter = 0;
        foreach($_POST as $key => $value ) {
            if ($value == "IN CART") {
                $file = fopen("../info.txt", "r");
                while (!feof($file)) {
                    $line = fgets($file);
                    if ($line != "") {
                        $array = explode(",", $line);
                        if ($key == $array[4]) {
                            $counter = $counter + 1;
                            echo "<tr>";
                            echo "<td><img src='../img/" . $array[1] . "'></td>";
                            echo "<td>" . $array[0] . "</td>";
                            echo "<td>$" . $array[3] . "</td>";
                            echo "</tr>";
                            $sum = $sum + intval($array[3]);
                            echo "<input type='hidden' name='Order " . $counter . "' value='" . $key . "'>";
                        }
                    }
                }
                fclose($file);
            }
        }
        //Sub-Total
        echo "<tr>";
        echo "<td></td>";
        echo "<td><strong>Sub-Total</strong></td>";
        echo "<td><strong>$" . strval(round($sum, 2)) . "</strong></td>";
        echo "</tr>";
        $sum = round($sum, 2);
        echo "<input type='hidden' name='Sub-Total' value='" . strval($sum) . "'>";
            
        //Sales Tax
        $salesTax = $sum * 0.08875;
        echo "<tr>";
        echo "<td></td>";
        echo "<td><strong>Sales Tax of 8.875%</strong></td>";
        echo "<td><strong>$" . strval(round($salesTax, 2)) . "</strong></td>";
        echo "</tr>";
        $salesTax = round($salesTax, 2);
        echo "<input type='hidden' name='Sales Tax' value='" . strval($salesTax) . "'>";
            
        //Grand Total
        $grandTotal = $sum + $salesTax;
        echo "<tr>";
        echo "<td></td>";
        echo "<td><strong>Grand Total</strong></td>";
        echo "<td><strong>$" . strval(round($grandTotal, 2)) . "</strong></td>";
        echo "</tr>";
        $grandTotal = round($grandTotal, 2);
        echo "<input type='hidden' name='Grand Total' value='" . strval($grandTotal) . "'>";
        ?>
        </table>
        <input type="submit" id="update" name="submit" value="Confirm">
    </form>
</div>
<footer></footer>
</body>
    <script src="../writeCookies.js" type="text/javascript"></script>
    <script>
        let welcome = document.getElementById("welcome");
        let output = checkCookies();
        
        if (output != "") {
            welcome.innerHTML = "Thank you, " + output + ", for your order!";
        } else {
            welcome.innerHTML = "Thank you for your order!";
        }
    </script>
</html>