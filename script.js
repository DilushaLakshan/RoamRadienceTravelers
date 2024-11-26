// popup message
function togglePopup() {
    document.getElementById("popup-1").classList.toggle("active");

}

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
                window.location = "driver-home.php";
            } else if (text == "guide") {
                window.location = "guide-home.php";
            } else if (text == "owner") {
                window.location = "ownerHome.php";
            } else {
                swal("", text, "error");
                userName.value = "";
                password.value = "";
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
                swal("", "Successfully Registered", "success");
            } else {
                swal("", text, "error");
            }
        }
    }

    //clear text fields of user registration page
    function clearUserRegistration() {
        fName.value = "";
        lName.value = "";
        email.value = "";
        password.value = "";
        houseNo.value = "";
        street1.value = "";
        street2.value = "";
        contact.value = "";
    }

    request.open("POST", "user-registration-process.php", true);
    request.send(form);
}

// update user details
function updateTraveler() {
    var fName = document.getElementById("fName");
    var lName = document.getElementById("lName");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var contact = document.getElementById("contact");
    var homeNo = document.getElementById("hNo");
    var street1 = document.getElementById("street1");
    var street2 = document.getElementById("street2");

    var dataObject = new Object();
    dataObject.fName = fName.value;
    dataObject.lName = lName.value;
    dataObject.email = email.value;
    dataObject.password = password.value;
    dataObject.contact = contact.value;
    dataObject.homeNo = homeNo.value;
    dataObject.street1 = street1.value;
    dataObject.street2 = street2.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "Success") {
                swal("Successfully Updated", "", "success");
            } else {
                swal(text, "", "error");
            }
        }
    }
    request.open("POST", "updateUserProcess.php", true);
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
            if (text == "success") {
                swal("Registres success", "", "success");
            } else {
                swal(text, "", "error");
            }
        }
    }
    request.open("POST", "staff-registration-process.php", true);
    request.send(form);
}

// send data for update staff memebers
function updateStaffMember(mID) {
    var mID = mID;
    var fName = document.getElementById("f-name");
    var lName = document.getElementById("l-name");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var role = document.getElementById("role");
    var contact = document.getElementById("contact");

    var dataObject = new Object();
    dataObject.mID = mID;
    dataObject.fName = fName.value;
    dataObject.lName = lName.value;
    dataObject.email = email.value;
    dataObject.password = password.value;
    dataObject.role = role.value;
    dataObject.contact = contact.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("Successfully updated", "", "success");
            } else {
                swal(text, "", "error");
            }
        }
    }
    request.open("POST", "updateStaffProcess.php", true);
    request.send(form);
}

// block staff user
function blockUnblockUser(mID, statusID) {
    var mID = mID;
    var statusID = statusID;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("Status updated", "", "success");
            } else {
                swal(text, "", "error");
            }
        }
    }
    request.open("GET", "updateStaffStatus.php?mID=" + mID + "&sID=" + statusID, true);
    request.send();
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
    var desDetails = CKEDITOR.instances.desDetails.getData();

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
    obj.details = desDetails;
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
                desName.value = "";
                desDetails = "";
                catValues = [];
                listValues = [];
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "addDestinationProcess.php", true);
    request.send(form);
}

// update destination data
function updateDestination(desID) {
    var desID = desID;
    var name = document.getElementById("name");
    var description = CKEDITOR.instances.description.getData();
    var mainImage = document.getElementById("main-image");

    var dataObject = new Object();
    dataObject.desID = desID;
    dataObject.name = name.value;
    dataObject.description = description;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("path", mainImage.files[0]);
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                alert("Successfully updated");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "updateDestinationProcess.php", true);
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
    return destValues;
}

// get vehicle ids from the model and set it to the add-tourpackages.php file
function getVehicleIDs() {
    var vehicleList = document.getElementsByName("v-id");
    var selectedVehicles = [];

    for (var x = 0; x < vehicleList.length; x++) {
        if (vehicleList[x].checked) {
            selectedVehicles.push(vehicleList[x].value);
        }
    }
    document.getElementById("v-id-list").innerHTML = selectedVehicles;
}

// get hotel ids from the model and set it to the add-tourpackages.php file
function getHotelIDs() {
    var hotelList = document.getElementsByName("hotel");
    var selectedHotels = [];

    for (var x = 0; x < hotelList.length; x++) {
        if (hotelList[x].checked) {
            selectedHotels.push(hotelList[x].value);
        }
    }

    document.getElementById("hotel-id-list").innerHTML = selectedHotels;
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
    var type = "a/c";
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

// update hotel details
function updateHotel(id) {
    var hID = id;
    var name = document.getElementById("h-name-" + hID);
    var address = document.getElementById("h-address-" + hID);
    var email = document.getElementById("h-email-" + hID);
    var contact = document.getElementById("h-contact-" + hID);
    var numberOfRooms = document.getElementById("h-rooms-" + hID);
    var roomNumbers = document.getElementById("h-room-number-" + hID);
    var pricePerRoom = document.getElementById("h-room-price-" + hID);

    var dataObject = new Object();
    dataObject.hID = hID;
    dataObject.name = name.value;
    dataObject.address = address.value;
    dataObject.email = email.value;
    dataObject.contact = contact.value;
    dataObject.numberOfRooms = numberOfRooms.value;
    // dataObject.roomNumbers = roomNumbers.value;
    dataObject.pricePerRoom = pricePerRoom.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                alert("Successfully updated");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "updateHotelProcess.php", true);
    request.send(form);
}

// get and send data to the addVehicleProcess.php
function addVehicle() {
    var vehicleNum = document.getElementById("v-number");
    var numOfSeats = document.getElementById("v-seats");
    var prPerKm = document.getElementById("price-km");
    var prPerDay = document.getElementById("price-day");
    var typeList = document.getElementsByName("v-type");
    var vType;

    for (var x = 0; x < typeList.length; x++) {
        if (typeList[x].checked) {
            vType = typeList[x].value;
        }
    }

    const dataObject = new Object();
    dataObject.vehicleNum = vehicleNum.value;
    dataObject.numOfSeats = numOfSeats.value;
    dataObject.prPerKm = prPerKm.value;
    dataObject.prPerDay = prPerDay.value;
    dataObject.vType = vType;

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

// update vehicle details
function updateVehicle(vID) {
    var vID = vID;
    var vNum = document.getElementById("v-num-" + vID);
    var noOfSeats = document.getElementById("v-seats-" + vID);
    var pricePerKm = document.getElementById("v-price-km-" + vID);
    var pricePerDay = document.getElementById("v-price-day-" + vID);

    var dataObject = new Object();
    dataObject.vID = vID;
    dataObject.vNum = vNum.value;
    dataObject.noOfSeats = noOfSeats.value;
    dataObject.prPerKm = pricePerKm.value;
    dataObject.prPerDay = pricePerDay.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                alert("Updated successful");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "updateVehicleProcess.php", true);
    request.send(form);
}

// diplay selected image for main image
function mainImagePreview() {
    var imagePath = document.getElementById("main-image");
    var imagePathTemp = document.getElementById("m-image");

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

// display images except main image
function optionalImagePreview() {
    var imagePath = document.getElementById("optional-images");
    var imageElements = [
        document.getElementById("img-1"),
        document.getElementById("img-2"),
        document.getElementById("img-3"),
        document.getElementById("img-4")
    ];

    imagePath.onchange = function() {
        var fileCount = imagePath.files.length;
        if (fileCount === 4) {
            for (var x = 0; x < fileCount; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                imageElements[x].src = url;
            }
        } else {
            alert("Please choose exactly 4 images.");
        }
    };
}

// get and send tour package details to addTourpackageProcess.php file
function addTourPackage() {
    var name = document.getElementById("name");
    var price = document.getElementById("price");
    var hText = document.getElementById("h-text");
    var description = CKEDITOR.instances.description.getData();
    var destinationList = document.getElementById("desIDList").innerText;
    var nuOfVehicles = document.getElementById("no-of-vehicles");
    var vehicleList = document.getElementById("v-id-list").innerText;
    var hotelList = document.getElementById("hotel-id-list").innerText;
    var durationList = document.getElementsByName("duration");
    var duration;
    var activityList = document.getElementsByName("activity-type");
    var activityType = [];
    var serviceList = document.getElementsByName("services");
    var highlights = document.getElementById("highlight");
    var serviceTypes = [];
    var milage = document.getElementById("milage");
    var mainImage = document.getElementById("main-image");

    // consider about this
    var optionalImageElements = document.getElementById("optional-images");

    for (var x = 0; x < durationList.length; x++) {
        if (durationList[x].checked) {
            duration = durationList[x].value;
        }
    }

    for (var y = 0; y < activityList.length; y++) {
        if (activityList[y].checked) {
            activityType.push(activityList[y].value);
        }
    }

    for (var z = 0; z < serviceList.length; z++) {
        if (serviceList[z].checked) {
            serviceTypes.push(serviceList[z].value);
        }
    }

    const dataObject = new Object();
    dataObject.name = name.value;
    dataObject.price = price.value;
    dataObject.hText = hText.value;
    dataObject.description = description;
    dataObject.destinationList = destinationList;
    dataObject.nuOfVehicles = nuOfVehicles.value;
    dataObject.vehicleList = vehicleList;
    dataObject.hotelList = hotelList;
    dataObject.duration = duration;
    dataObject.milage = milage.value;
    dataObject.activityType = activityType;
    dataObject.serviceTypes = serviceTypes;
    dataObject.highlights = highlights.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("tourPackageData", jsonText);
    form.append("mainImage", mainImage.files[0]);

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
    request.open("POST", "addTourpackageProcess.php", true);
    request.send(form);
}

// tour package filter process
function appplyFilters() {
    var lowToHigh = document.getElementById("l-h");
    var highToLow = document.getElementById("h-l");
    var priceOrder = null;

    var durationList = document.getElementsByName("duration");
    var durIDList = [];
    for (var a = 0; a < durationList.length; a++) {
        if (durationList[a].checked) {
            durIDList.push(durationList[a].value);
        }
    }

    var activityList = document.getElementsByName("activity-type");
    var activityTypeArray = [];
    for (var b = 0; b < activityList.length; b++) {
        if (activityList[b].checked) {
            activityTypeArray.push(activityList[b].value);
        }
    }

    if (lowToHigh.checked) {
        priceOrder = 'ASC';
    } else if (highToLow.checked) {
        priceOrder = 'DESC';
    } else {
        priceOrder = null;
    }

    const filterObject = new Object();
    filterObject.priceOrder = priceOrder;
    filterObject.durIDList = durIDList;
    filterObject.activityTypeArray = activityTypeArray;

    var jsonText = JSON.stringify(filterObject);

    var form = new FormData();
    form.append("filterData", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            document.getElementById("packageArea").innerHTML = request.responseText;
        }
    }
    request.open("POST", "packageFilterProcess.php", true);
    request.send(form);
}

// send data for updating tour package
function updateTourPackage(packageID) {
    var packageID = packageID;
    var name = document.getElementById("name");
    var price = document.getElementById("price");
    var hText = document.getElementById("h-text");
    var description = CKEDITOR.instances.description.getData();
    var destinationList = document.getElementById("desIDList").innerText;
    var durationList = document.getElementsByName("duration");
    var duration;
    var activityList = document.getElementsByName("type");
    var activityType = [];
    var serviceList = document.getElementsByName("services");
    var highlights = document.getElementById("highlight");
    var serviceTypes = [];
    var milage = document.getElementById("milage");
    var mainImage = document.getElementById("main-image");

    for (var x = 0; x < durationList.length; x++) {
        if (durationList[x].checked) {
            duration = durationList[x].value;
        }
    }

    for (var y = 0; y < activityList.length; y++) {
        if (activityList[y].checked) {
            activityType.push(activityList[y].value);
        }
    }

    for (var z = 0; z < serviceList.length; z++) {
        if (serviceList[z].checked) {
            serviceTypes.push(serviceList[z].value);
        }
    }

    const dataObject = new Object();
    dataObject.packageID = packageID;
    dataObject.name = name.value;
    dataObject.price = price.value;
    dataObject.hText = hText.value;
    dataObject.description = description;
    dataObject.destinationList = destinationList;
    dataObject.duration = duration;
    dataObject.milage = milage.value;
    dataObject.activityType = activityType;
    dataObject.serviceTypes = serviceTypes;
    dataObject.highlights = highlights.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("tourPackageData", jsonText);
    form.append("mainImage", mainImage.files[0]);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "Success") {
                alert("Successfully updated");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "updateTourPackageProcess.php", true);
    request.send(form);
}

// update the status of the tour package
function updatePackageStatus(pID, status) {
    var pID = pID;
    var status = status;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                alert("Status updated");
            } else {
                alert(text);
            }
        }
    }
    request.open("GET", "updatePackageValidity.php?pID=" + pID + "&status=" + status, true);
    request.send();
}

// check the tour package availability from the client-side
function checkPackageAvailability(packageID) {
    var packageID = packageID;
    var date = document.getElementById("checking-date");

    var form = new FormData();
    form.append("packageID", packageID)
    form.append("date", date.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;

            document.getElementById("available-status").innerHTML = text;
        }
    }
    request.open("POST", "packageAvailability.php", true);
    request.send(form);
}

// get and send booking data to the bookingProcess.php file
function sendBookingData(packageID) {
    var pID = packageID;
    var date = document.getElementById("checking-date");
    var noOfMembers = document.getElementById("booking-members");
    var description = document.getElementById("booking-des");
    var availability = document.getElementById("available-status").innerText;

    if (availability == "Yes") {
        var dataObject = new Object();
        dataObject.pID = pID;
        dataObject.date = date.value;
        dataObject.noOfMembers = noOfMembers.value;
        dataObject.description = description.value;

        var jsonText = JSON.stringify(dataObject);

        var form = new FormData();
        form.append("jsonText", jsonText);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var text = request.responseText;
                if (text == "success") {
                    alert("Your Booking is now pending for confirmation");
                } else {
                    alert(text);
                }
            }
        }
        request.open("POST", "bookingProcess.php", true);
        request.send(form);
    } else if ("No") {
        alert("Thing package is not avalable on " + date.value);
    } else {
        alert("Check the availability first");
    }
}

// update booking status
function updateStatus(travelerID, bookingID, statusID) {
    var travelerID = travelerID;
    var bookingID = bookingID;
    var statusID = statusID;

    var availability = document.getElementById("availability").innerText;
    if (availability == "Yes") {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var text = request.responseText;
                if (text == "success") {
                    alert("Status Updated");
                } else {
                    alert(text);
                }
            }
        }
        request.open("GET", "updateBookingStatusProcess.php?tID=" + travelerID + "&statusID=" + statusID + "&bID=" + bookingID, true);
        request.send();
    } else {
        alert("This package is not available for this date");
    }
}


// booking confirmation
function confirmBooking(travelerID) {
    var travelerID = travelerID;
    var availability = document.getElementById("availability").innerText;

    if (availability == "Yes") {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var text = request.responseText;
                if (text == "success") {
                    alert("Confirmed");
                } else {
                    alert(text);
                }
            }
        }
        request.open("GET", "bookingConfirmProcess.php?tID=" + travelerID, true);
        request.send();
    } else {
        alert("This package is not available for this date");
    }
}

// booking proceed to payment
function proceedToPayment(travelerID) {
    var travelerID = travelerID;
    var availability = document.getElementById("availability").innerText;

    if (availability == "Yes") {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var text = request.responseText;
                if (text == "success") {
                    alert("Proceed to Payment");
                } else {
                    alert(text);
                }
            }
        }
        request.open("GET", "paymentProceedProcess.php?tID=" + travelerID, true);
        request.send();
    } else {
        alert("This package is not available for this date");
    }
}

// tour planning module
function sendTourPlanningDetails() {
    var name = document.getElementById("name");
    var tourDate = document.getElementById("t-date");
    var desIDList = document.getElementById("desIDList");
    var desIDArray = desIDList.textContent.split(",").map(Number);

    var dataObject = new Object();
    dataObject.name = name.value;
    dataObject.tourDate = tourDate.value;
    dataObject.desIDArray = desIDArray;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "Success") {
                alert("Insertion Successful");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "tourPlanProcess.php", true);
    request.send(form);
}

// arrange the packing list according to the destination list
function setPackingList() {
    var desIDList = document.getElementById("desIDList");
    var desIDArray = desIDList.textContent.split(",").map(Number);

    var dataObject = new Object();
    dataObject.desIDArray = desIDArray;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            document.getElementById("p-list-item").innerHTML = text;
        }
    }
    request.open("POST", "setPackingList.php", true);
    request.send(form);
}

// check whether the user logged in or not
function addDestinationComment(uID) {
    var uID = uID;

    if (uID == 0) {
        window.location = "login.php";
    }
}

// send comment to the addDestinationComment.php
function addDesComment(desID) {
    var desID = desID;
    var comment = document.getElementById("comment");

    var form = new FormData();
    form.append("comment", comment.value);
    form.append("desID", desID);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                alert("Comment added");
                comment.value = "";
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "desCommentProcess.php", true);
    request.send(form);
}

// add comment for the tour package
function addPackageComment(packageID) {
    var rate = document.getElementById("rating-status").innerText;
    var description = document.getElementById("add-comment");
    var packageID = packageID;

    var form = new FormData();
    form.append("rate", rate);
    form.append("description", description.value);
    form.append("packageID", packageID);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("Comment added", "", "success");
            } else if (text == "login") {
                window.location = "login.php";
            } else {
                swal(text, "", "warning");
            }
        }
    }
    request.open("POST", "addPackageComment.php", true);
    request.send(form);
}

// manage drivers with vehicles
function manageDriverVehicle(mID) {
    var memberID = mID;
    var vehicleID = document.getElementById("vehicle");

    var form = new FormData();
    form.append("memberID", memberID);
    form.append("vehicleID", vehicleID.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                alert("Vehicle assigned");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "driverWithVehicleProcess.php", true);
    request.send(form);
}

// manage guides and tour packages
function manageGuideWithPackage(memberID, selectionAreaID) {
    var memberID = memberID;
    var selectionAreaID = selectionAreaID;
    var packageID = document.getElementById("package-" + selectionAreaID);

    var dataObject = new Object();
    dataObject.memberID = memberID;
    dataObject.packageID = packageID.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                alert("Package assigned");
            } else {
                alert(text);
            }
        }
    }
    request.open("POST", "guideWithPackProcess.php", true);
    request.send(form);
}

// send prmotion details 
function newPromotion() {
    var name = document.getElementById("name");
    var discription = CKEDITOR.instances.description.getData();
    var discount = document.getElementById("discount");
    var startDate = document.getElementById("s-date");
    var endDate = document.getElementById("end-date");
    var image = document.getElementById("formFile").files[0];
    // consider about this
    var status = document.getElementsByName("status");


    var dataObject = new Object();
    dataObject.name = name.value;
    dataObject.discription = discription;
    dataObject.discount = discount.value;
    dataObject.startDate = startDate.value;
    dataObject.endDate = endDate.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);
    form.append("imagePath", image)

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Promotion added", "success");
            } else {
                swal("", text, "error");
            }
        }
    }
    request.open("POST", "addPromotionProcess.php", true);
    request.send(form);
}

// update promotion details
function upadtePromotion(proID) {
    var proID = proID;
    var name = document.getElementById("name");
    var discription = CKEDITOR.instances.description.getData();
    var discount = document.getElementById("discount");
    var startDate = document.getElementById("s-date");
    var endDate = document.getElementById("end-date");
    var image = document.getElementById("formFile").files[0];
    // consider about this
    var status = document.getElementsByName("status");


    var dataObject = new Object();
    dataObject.proID = proID;
    dataObject.name = name.value;
    dataObject.discription = discription;
    dataObject.discount = discount.value;
    dataObject.startDate = startDate.value;
    dataObject.endDate = endDate.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);
    form.append("imagePath", image)

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Promotion updated", "success");
            } else {
                swal("", text, "error");
            }
        }
    }
    request.open("POST", "updatePromotionProcess.php", true);
    request.send(form);
}

// assign promotions with tour packages
function getPackageList() {
    var packageIdList = document.getElementsByName("selection");
    var selectedPackageList = [];

    for (var x = 0; x < packageIdList.length; x++) {
        if (packageIdList[x].checked) {
            selectedPackageList.push(packageIdList[x].value);
        }
    }
}

// update promotion validity/ status
function upadtePromotionStatus(proID, status) {
    var proID = proID;
    var status = status;

    var dataObject = new Object();
    dataObject.proID = proID;
    dataObject.status = status;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Status updated", "success");
            } else {
                swal("", text, "error");
            }
        }
    }
    request.open("POST", "updatePromoStatus.php", true);
    request.send(form);
}

// visual bar charts
// bar chart
function displayHardcodedChart() {
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Package A', 'Package B', 'Package C', 'Package D', 'Package E', 'Package F'],
            datasets: [{
                label: 'Demanding Tour Packages',
                data: [500, 1000, 197, 800, 500, 200], // Hardcoded values
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// line chart
function displayLineChart() {
    const ctx = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octomber', 'November', 'December'],
            datasets: [{
                label: 'Monthly Customers',
                data: [200, 150, 140, 300, 500, 200, 100, 400, 350, 400, 380, 400], // Hardcoded values for line chart
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: true // Set to true to fill the area under the line
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// profit diaplying bar chart
function displayGroupedBarChart() {
    const ctx = document.getElementById('groupedBarChart').getContext('2d');
    const groupedBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octomber', 'November', 'December'],
            datasets: [{
                    label: 'Profit (in USD)',
                    data: [8000, 12000, 4000, 7000, 3000, 5000], // Hardcoded values for profit
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Expenses (in USD)',
                    data: [4000, 7000, 2000, 3000, 1000, 2000], // Hardcoded values for expenses
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}