<?php
ini_set('display_errors', true);
	ini_set('display_startup_errors', true);
	error_reporting(E_ALL);
?>
<!Doctype html>
<html>
<head>
    <title>Assignment 8: Cannabis Cart</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body onload="showModal()">
    <div id="welcome">
        <form action="main.php" method="POST">
        <h3>Assignment 8: Cannabis Shopping Cart</h3>
        <h4 id="message"></h4>
        <div class="bottomMargin" id="bottomMargin">
            <h5>First Name: </h5>
            <input type="text" name="firstName">
            <h5>Last Name: </h5>
            <input type="text" name="lastName">
            <h5>Email: </h5>
            <input type="text" name="email" id="email">
        </div>
            <input type="submit" id="enter" class="enter" value="Click Here to Enter">
        </form>
    </div>
    <!--- Modal ---->
    <div class="modal hide" id="modal">
        <div class="container">
            <h4>You must be 21 years old or older to continue!</h4>
            <button id="continue">I am 21 years old</button>
        </div>
    </div>
</body>
    <script src="writeCookies.js" type="text/javascript"></script>
    <script>
        let modal = document.getElementById("modal");
        let welcome = document.getElementById("welcome");
        let hide = document.getElementById("hide");
        let enter = document.getElementById("enter");
        let continueButton = document.getElementById("continue");
        let bottomMargin = document.getElementById("bottomMargin");

        function showModal() {
            if (modal.classList.contains("hide")) {
                modal.classList.remove("hide");
            }

            if (!modal.classList.contains("hide")) {
                welcome.classList.add("hide");
            }
        }

        function showRest() {
            if (welcome.classList.contains("hide")) {
                welcome.classList.remove("hide");
            }
            if (!modal.classList.contains("hide")) {
                modal.classList.add("hide");
            }
        }
        enter.addEventListener("click", function() {
            writeCookies(this.form);
        });

        continueButton.addEventListener("click", showRest);
        let word = checkCookies();
        let message = document.getElementById('message');
        if (word != "") {
            console.log(word);
            message.innerHTML = "Welcome, " + word + "!";
            bottomMargin.classList.add("hide");
        }
    </script>
</html>
