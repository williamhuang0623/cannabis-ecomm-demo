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
    <link href="php/shopping.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        #update {
            margin-bottom: -20px;
        }
    </style>
</head>

<body>
<header>
    <img src="img/logo.png">
</header>
<div class="jumbotron">
    <h1>Cannabis Shopping Cart</h1>
</div>
<h2 id="welcome"></h2>
<form method="POST" action="php/cart_summary.php">
<div class="container">
    <?php
    $file = fopen("info.txt", "r");
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
                echo "<img src='img/outofstock.jpg' class='row-image'>";
                echo "<p> Stock: " . $array[2] . "oz</p>";
                echo "<p> Price: $" . $array[3] . "</p>";

            } else {
                echo "<img src='img/" . $array[1] . "' class='row-image'>";
                echo "<p> Stock: " . $array[2] . "oz</p>";
                echo "<p> Price: $" . $array[3] . "</p>";
                //echo "<button class='order' id='" . $array[4] . "'>ORDER</button>";
                echo "<input type='text' class='order' value='ORDER' id='" . $array[4] . "' name='" . $array[4] . "' readonly >";
            }
            echo "</div>";

            if ($counter%4 == 3) {
                echo "</div>";
            }
            $counter++;
        }
    }
    fclose($file);
    ?>
    </div>
    <input type="submit" id="update" name="submit" value="submit">
    <a href="php/change_stock.php"><button type="button" class="submit">Change Stock (Merchant Portal)</button></a>
</form>
<footer></footer>
</body>
    <script src="writeCookies.js" type="text/javascript"></script>
    <script>
        let message = checkCookies();
        let welcomeMessage = document.getElementById("welcome");
        if (!message == "") {
            welcomeMessage.innerHTML = "Welcome, " + message + "! Please make your selections.";
        }

        //JQUERY BUTTONS
        $.fn.toggleVal = function(t1, t2){
            if (this.val() == t1) this.val(t2);
            else                   this.val(t1);
            return this;
        };
        $.fn.toggleText = function(t1, t2){
            if (this.text() == t1) this.text(t2);
            else                   this.text(t1);
            return this;
        };
        $('.order').on('click', function() {
            let id = $(this).attr("id");
            $("#"+id).toggleClass("red");
            $("#"+id).toggleVal("ORDER", "IN CART");
            return false;
        })

        let update = document.getElementById("update");
        update.addEventListener("click", function(event) {
            let x = formSubmit();
            if (!x) {
                event.preventDefault()
            }
        });
    </script>
</html>
