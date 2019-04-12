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
    <style>
    #email {
        text-align: center;
        margin-bottom: 40px;
        margin-top: 20px;
    }
    </style>
</head>

<body>
<header>
    <img src="../img/logo.png">
</header>
<div class="jumbotron">
    <h1>Thanks for Ordering!</h1>
</div>
<div class="container">
   <?php
        foreach($_POST as $key => $value) {
            //Opening text files
            $input = fopen("../info.txt", "r");
            $iterate = false;
            while (!feof($input)) {
                $line = fgets($input);
                if ($line != "") {
                    $array = explode(",", $line);
                    if ($value == $array[4]) {
                    $iterate = true;
                    }
                }
            }
            fclose($input);

            if ($iterate) {
                $input = fopen("../info.txt", "r");
                $output = fopen("../output.txt", "w");
                while (!feof($input)) {
                    $line = fgets($input);
                    $newline = "";
                    if ($line != "") {
                        $array = explode(",", $line);
                        if ($value == $array[4]) {
                            $new_stock = intval($array[2]) - 1;
                            $newline = $array[0] . "," . $array[1] . "," . strval($new_stock) . "," . $array[3] . "," . $array[4] . "," . "\n";
                        } else {
                            $newline = $line;
                        };
                        fwrite($output, $newline);
                    }
                }
                fclose($output);
                fclose($input);
            }
        }
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

    //Create Email Message
    $message = "Thank you for your order! \n\n Here is your order summary: \n";
    foreach($_POST as $key => $value) {
        if ($key != "submit") {
            $message .= $key . " " . $value . "\n";
        }
    }
    $message .= "\n Please let us know if there was a problem with your order.";

    $to = $_COOKIE["email"] or $_COOKIE[" email"];
    $subject = "Order Confirmation";
    $headers = "From: wwh237@i6.cims.nyu.edu"."\r\n".
            "Reply-To: " . $to . "\r\n".
            "X-Mailer: PHP/" . phpversion();

    mail($to,$subject, $message,$headers);
    ?>
    <div class="row">
        <h2 id="welcome"></h2>
        <h4 id="email"></h4>
        <a href="../main.php"><button id="returnHome" class="submit">Return to Home</button></a>
    </div>
</div>
<footer></footer>
</body>
    <script src="../writeCookies.js" type="text/javascript"></script>
    <script>
        function checkEmail() {
            let email = "";
            if (!document.cookie=="") {
                let cookies = document.cookie.split(";");
                console.log(cookies)
                for (let i = 0; i < cookies.length; i++) {
                    let cookieName = cookies[i].split("=")[0];
                    let cookieValue = cookies[i].split("=")[1];

                    if (cookieName == "email" || cookieName == " email") {
                        email = cookieValue;
                    }
                }
                return email;
            }
            return "";
        }

        let welcome = document.getElementById("welcome");
        let email = document.getElementById("email");
        let output = checkCookies();
        if (output != "") {
            welcome.innerHTML = "Thank you, " + output;
        }
        let emailOutput = checkEmail();
        console.log(emailOutput);
        if (emailOutput != "") {
            email.innerHTML = "Your order is on the way and a verification email has been sent to " + emailOutput;
        }
    </script>
</html>
