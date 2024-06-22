// send login details
function sendLoginDetails() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "traveler") {
                window.location = "index.php";
            } else if (text == "admin") {
                window.location = "admin-home.php";
            } else if (text == "driver") {
                window.location = "drive-home.php";
            } else if (text == "guide") {
                window.location = "guide-home.php";
            } else {
                alert(text);
                userName.innerHTML = "";
                password.innerHTML = "";
            }
        }
    }
    request.open("POST", "loginPrcess.php", true);
    request.send(form);
}

//send user registration details
function registerUser() {
    var fName = document.getElementById("fName");
    var lName = document.getElementById("lName");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var contact = document.getElementById("contact");
    var houseNo = document.getElementById("house");
    var street1 = document.getElementById("st1");
    var street2 = document.getElementById("st2");

    var form = new FormData();
    form.append("firstName", fName.value);
    form.append("lastName", lName.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("contact", contact.value);
    form.append("houseNo", houseNo.value);
    form.append("street1", street1.value);
    form.append("street2", street2.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                alert("Success");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "user-registration-process.php", true);
    request.send(form);
}

//send staff registration details
function registerStaff() {

    var fName = document.getElementById("fName");
    var lName = document.getElementById("lName");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var role = document.getElementById("role");
    var contact = document.getElementById("contact");

    var form = new FormData();
    form.append("firstName", fName.value);
    form.append("lastName", lName.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("role", role.value);
    form.append("contact", contact.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            alert(text);
        }
    }
    request.open("POST", "staff-registration-process.php", true);
    request.send(form);
}