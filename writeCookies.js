function writeCookies(form) {

    let message = document.getElementById('message');
    if (!message.innerHTML == "") {
        return
    }

    let fname = form.firstName.value;
    let lname = form.lastName.value;
    let email = form.email.value;

    if (fname == "") {
        alert("First name field cannot be blank");
        return false;
    }

    if (lname == "") {
        alert("Last name field cannot be blank");
        return false;
    }
    for (let i = 0; i<email.length; i++) {
        if (email[i] == "@") {
            alert("Invalid email.");
            return false;
        }
    }
    if (email.length < 1) {
        alert("Email length not valid. Please enter email with at least one character.");
        return false;
    }

    email = email;
    let expire = new Date();
    expire = expire.getMilliseconds() + 60000*30;
    if(document.cookie == "") {
        document.cookie = "firstName=" + fname + ";expires=" + expire;
        document.cookie = "lastName=" + lname + ";expires=" + expire;
        document.cookie = "email=" + email + ";expires=" + expire;
    } else {
        console.log("No cookies were written");
    }
}

function checkCookies() {
    let firstName = "";
    let lastName = "";
    if (!document.cookie=="") {
        let cookies = document.cookie.split(";");
        console.log(cookies)
        for (let i = 0; i < cookies.length; i++) {
            let cookieName = cookies[i].split("=")[0];
            let cookieValue = cookies[i].split("=")[1];

            if (cookieName == "firstName") {
                firstName = cookieValue;
            }
            if (cookieName == "lastName" || cookieName == " lastName") {
                lastName = cookieValue;
            }
        }
        let output = firstName + " " + lastName;
        return output;
    }
    return "";
}

function validateInputs() {
    let bool = false;
    $('input').each(function() {
        let value = $(this).val();

        if (value == "IN CART") {
            bool = true;
            return false;
        }
    })
    return bool;
}
function formSubmit() {
    let x = validateInputs();

    if (x) {
        return true;
    } else {
        alert("There is nothing in cart!");
        return false;
    }
}
