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
                clearUserRegistration();
            } else {
                alert(text);
                clearUserRegistration()
            }
        }
    }

    //clear text fields of user registration page
    function clearUserRegistration() {
        fName.innerHTML = "";
        lName.innerHTML = "";
        email.innerHTML = "";
        password.innerHTML = "";
        houseNo.innerHTML = "";
        street1.innerHTML = "";
        street2.innerHTML = "";
        contact.innerHTML = "";
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

// set image to the preview box - add destination
function imagePreview() {
    var imagePath = document.getElementById("formFile");
    var imagePathTemp = document.getElementById("des-image");

    imagePath.onchange = function() {
        var fileCount = imagePath.files.length;
        if (fileCount == 1) {
            var file = this.files[0];
            var url = window.URL.createObjectURL(file);
            imagePathTemp.src = url;
        } else {
            alert("You can choose only one image");
        }
    }
}

// get and send data of add-destination page
function sendDestinationDetails() {
    var desName = document.getElementById("des-name");
    var desImage = document.getElementById("formFile");
    var desDetails = document.getElementById("des-details");

    var desCategories = document.getElementsByName("categories[]");
    var catValues = [];
    for (var i = 0, n = desCategories.length; i < n; i++) {
        if (desCategories[i].checked) {
            catValues.push(desCategories[i].value);
        }
    }

    var packingList = document.getElementsByName("packingList[]");
    var listValues = [];
    for (var j = 0, m = packingList.length; j < m; j++) {
        if (packingList[j].checked) {
            listValues.push(packingList[j].value);
        }
    }

    const obj = new Object();
    obj.name = desName.value;
    obj.details = desDetails.value;
    obj.catValues = catValues;
    obj.listValues = listValues;

    var jsonText = JSON.stringify(obj);

    var form = new FormData();

    form.append("path", desImage.files[0]);
    form.append("otherDetails", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "Success") {
                alert("Insertion Success");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "addDestinationProcess.php", true);
    request.send(form);
}

// get destination ids from the model and set it to the add-tourpackages.php file
function getDestinationIDs() {
    var destinationList = document.getElementsByName("destination");
    var destValues = []
    for (var x = 0, y = destinationList.length; x < y; x++) {
        if (destinationList[x].checked) {
            destValues.push(destinationList[x].value);
        }
    }

    document.getElementById("desIDList").innerHTML = destValues;
}

// send hotel details to addHotelProcess.php
function addHotel() {
    var hName = document.getElementById("h-name");
    var address = document.getElementById("h-address");
    var email = document.getElementById("h-email");
    var contact = document.getElementById("h-contact");
    var numberOfRooms = document.getElementById("h-rooms");
    var roomNumbers = document.getElementById("room-numbers");
    var typeList = document.getElementsByName("type");
    var type;
    var pricePerRoom = document.getElementById("h-price");

    for (var x = 0; x < typeList.length; x++) {
        if (typeList[x].checked) {
            type = typeList[x].value;
        }
    }

    const dataSendingObj = new Object();
    dataSendingObj.hotelName = hName.value;
    dataSendingObj.hotelAddress = address.value;
    dataSendingObj.email = email.value;
    dataSendingObj.contact = contact.value;
    dataSendingObj.numberOfRooms = numberOfRooms.value;
    dataSendingObj.roomNumbers = roomNumbers.value;
    dataSendingObj.roomType = type;
    dataSendingObj.pricePerRoom = pricePerRoom.value;

    var jsonText = JSON.stringify(dataSendingObj);

    var form = new FormData();
    form.append("hotelData", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "Success") {
                alert("Insertion Success");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "addHotelProcess.php", true);
    request.send(form);
}

// get and send data to the addVehicleProcess.php
function addVehicle() {
    var vehicleNum = document.getElementById("v-number");
    var numOfSeats = document.getElementById("v-seats");
    var prPerKm = document.getElementById("price-km");
    var prPerDay = document.getElementById("price-day");

    const dataObject = new Object();
    dataObject.vehicleNum = vehicleNum.value;
    dataObject.numOfSeats = numOfSeats.value;
    dataObject.prPerKm = prPerKm.value;
    dataObject.prPerDay = prPerDay.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("vehicleData", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "Success") {
                alert("Insertion Success");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "addVehicleProcess.php", true);
    request.send(form);
}