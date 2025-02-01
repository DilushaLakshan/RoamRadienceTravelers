// popup message
function togglePopup() {
    document.getElementById("popup-1").classList.toggle("active");

}

// forgot password - display email-section
function forgotPassword() {
    document.getElementById("login-section").classList.add("d-none");

    document.getElementById("email-section").classList.remove("d-none");
}

// check email for forgot password
function checkEmail() {
    var email = document.getElementById("email-2");

    var form = new FormData();
    form.append("email", email.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                document.getElementById("email-section").classList.add("d-none");

                document.getElementById("otp-section").classList.remove("d-none");
            } else {
                swal("", text, "error");
            }
        }
    }
    request.open("POST", "checkEmail.php", true);
    request.send(form);
}

// validate email - forgot password
function validateOTP() {
    const email = document.getElementById("email-2");
    var otp = document.getElementById("otp-number");

    var form = new FormData();
    form.append("email", email.value);
    form.append("otp", otp.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                document.getElementById("otp-section").classList.add("d-none");

                document.getElementById("reset-password-section").classList.remove("d-none");
            } else {
                swal("", text, "error");
            }
        }
    }
    request.open("POST", "validateOtpProcess.php", true);
    request.send(form);
}

// forgot password - reset password
function resetPassword() {
    const email = document.getElementById("email-2");
    const passwordNew = document.getElementById("password-1");
    const confirmPassword = document.getElementById("password-2");

    var form = new FormData();
    form.append("email", email.value);
    form.append("newPassword", passwordNew.value);
    form.append("confirmPassword", confirmPassword.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Password updated successfully", "success").then(() => {
                    setTimeout(() => {
                        window.location.href = "login.php";
                    }, 2000);
                });
            } else {
                swal("", text, "error").then(() => {
                    setTimeout(() => {
                        window.location.href = "login.php";
                    }, 2000);
                });
            }
        }
    }
    request.open("POST", "resetPasswordProcess.php", true);
    request.send(form);
}

// apply destination filter
function applyDestinationFilter() {
    var destinationCategoryList = document.getElementsByName("category");
    var selectedCategoryList = [];

    for (var x = 0; x < destinationCategoryList.length; x++) {
        if (destinationCategoryList[x].checked) {
            selectedCategoryList.push(destinationCategoryList[x].value);
        }
    }

    var dataObject = new Object();
    dataObject.selectedCategoryList = selectedCategoryList;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            document.getElementById("destination-area").innerHTML = request.responseText;
        }
    };
    request.open("POST", "destinationFilterProcess.php", true);
    request.send(form);
}

// payment process
function makePayment(packageId, bookingId) {
    var packageId = packageId;
    var bookingId = bookingId;

    var dataObject = new Object();
    dataObject.packageId = packageId;
    dataObject.bookingId = bookingId;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            var responseObject = JSON.parse(response);

            // Define PayHere callbacks
            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID:", orderId);
                // Handle successful payment logic here
            };

            payhere.onDismissed = function onDismissed() {
                console.log("Payment dismissed");
            };

            payhere.onError = function onError(error) {
                console.error("Error:", error);
            };

            console.log(responseObject);

            // Start payment with response data from PHP
            payhere.startPayment(responseObject);
        }
    }
    request.open("POST", "paymentProcess.php", true);
    request.send(form);
}

// send inquiry
function sendInquiry() {
    var message = document.getElementById("inquiry-message");

    var form = new FormData();
    form.append("message", message.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Message sent", "success");
            } else {
                swal("", text, "warning");
            }
        } else {
            swal("", "Invalid request", "warning");
        }
    };
    request.open("POST", "sendInquiryProcess.php", true);
    request.send(form);
}

// Save special discount for booking
function setSpecDiscount(bookingId) {
    var bookingId = bookingId;

    var specDiscount = document.getElementById("spec-dis-" + bookingId);

    var form = new FormData();
    form.append("bookingId", bookingId);
    form.append("specDiscount", specDiscount.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Discount saved", "success");
            } else {
                swal("", text, "error");
            }
        }
    }
    request.open("POST", "saveSpecDiscountProcess.php", true);
    request.send(form);
}

// check notifications
function checkRealTimeNotification() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var count = parseInt(request.responseText, 10); // Ensure count is treated as an integer

            var notificationButton = document.getElementById("notificationButton");
            if (count > 0) {
                notificationButton.classList.add("notification-active");
            } else {
                notificationButton.classList.remove("notification-active");
            }

        }
    }
    request.open("POST", "checkNotificationProcess.php", true);
    request.send();
}

document.addEventListener("DOMContentLoaded", function() {
    checkRealTimeNotification(); // Initial check on page load
    setInterval(checkRealTimeNotification, 1000);
});


// fetch the calander
function displayCalendar(uID) {
    var calendarEl = document.getElementById("booking-calendar");

    if (!calendarEl) {
        console.error("Element with ID 'booking-calendar' not found.");
        return;
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Set the initial calendar view
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay',
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            var form = new FormData();
            form.append("uID", uID);

            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        try {
                            var events = JSON.parse(request.responseText);
                            console.log(events);
                            successCallback(events);
                        } catch (error) {
                            console.error("Error parsing response:", error);
                            failureCallback("Error processing events");
                        }
                    } else {
                        console.error("Failed to fetch events:", request.statusText);
                        failureCallback("Failed to load events");
                    }
                }
            };
            request.open("POST", "fetchBookingDates.php", true);
            request.send(form);
        },
        eventColor: '#18a09b', // Apply dark green theme for events
        eventClick: function(info) {
            // Alert booking details when an event is clicked
            alert(`Booking Date: ${info.event.start.toDateString()}`);
        },
    });

    // Render the calendar
    calendar.render();
}

// display booking dates - guide
function viewBookingDateCalGuide() {
    var calendarEl = document.getElementById("booking-calendar");

    if (!calendarEl) {
        console.error("Element with ID 'booking-calendar' not found.");
        return;
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Set the initial calendar view
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay',
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        try {
                            var events = JSON.parse(request.responseText);
                            console.log(events);
                            successCallback(events);
                        } catch (error) {
                            console.error("Error parsing response:", error);
                            failureCallback("Error processing events");
                        }
                    } else {
                        console.error("Failed to fetch events:", request.statusText);
                        failureCallback("Failed to load events");
                    }
                }
            };
            request.open("POST", "booking-date-guide.php", true);
            request.send();
        },
        eventColor: '#18a09b', // Apply dark green theme for events
        eventClick: function(info) {
            // Alert booking details when an event is clicked
            alert(`Booking Date: ${info.event.start.toDateString()}`);
        },
    });

    // Render the calendar
    calendar.render();
}

// display booking dates - driver
function viewBookingDateCalDriver() {
    var calendarEl = document.getElementById("booking-calendar");

    if (!calendarEl) {
        console.error("Element with ID 'booking-calendar' not found.");
        return;
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Set the initial calendar view
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay',
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        try {
                            var events = JSON.parse(request.responseText);
                            console.log(events);
                            successCallback(events);
                        } catch (error) {
                            console.error("Error parsing response:", error);
                            failureCallback("Error processing events");
                        }
                    } else {
                        console.error("Failed to fetch events:", request.statusText);
                        failureCallback("Failed to load events");
                    }
                }
            };
            request.open("POST", "booking-date-driver.php", true);
            request.send();
        },
        eventColor: '#18a09b', // Apply dark green theme for events
        eventClick: function(info) {
            // Alert booking details when an event is clicked
            alert(`Booking Date: ${info.event.start.toDateString()}`);
        },
    });

    // Render the calendar
    calendar.render();
}


// send inquiry reply
function sendInqReply(inqId) {
    var inqId = inqId;
    var replyMessage = document.getElementById("inq-reply-" + inqId);

    var form = new FormData();
    form.append("inqId", inqId);
    form.append("replyMessage", replyMessage.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;

            if (text == "success") {
                swal("", "Replied", "success").then(() => {
                    location.reload();
                });
            } else {
                swal("", text, "error");
            }
        }
    }

    request.open("POST", "inqReplyProcess.php", true);
    request.send(form);
}

// AOS initialization
document.addEventListener("DOMContentLoaded", () => {
    AOS.init({
        duration: 800, // Animation duration in milliseconds
        easing: 'ease-out', // Easing function
        once: true // Animation only happens once when scrolled into view
    });
});

// toggle the destination comment
function toggleComment(link) {
    const shortComment = link.previousElementSibling.previousElementSibling;
    const fullComment = link.previousElementSibling;

    if (fullComment.classList.contains('d-none')) {
        shortComment.classList.add('d-none');
        fullComment.classList.remove('d-none');
        link.textContent = "Read Less";
    } else {
        shortComment.classList.remove('d-none');
        fullComment.classList.add('d-none');
        link.textContent = "Read More";
    }
}

// add new category
function addCategory() {
    var categoryName = document.getElementById("new-catg");

    var form = new FormData();
    form.append("categoryName", categoryName.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Category added", "success");
            } else {
                swal("", text, "error");
            }
        }
    }
    request.open("POST", "addCategoryProcess.php", true);
    request.send(form);
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
                swal("", "Successfully Registered", "success").then(() => {
                    window.location = 'login.php';
                });
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

    // var packingList = document.getElementsByName("packingList[]");
    // var listValues = [];
    // for (var j = 0, m = packingList.length; j < m; j++) {
    //     if (packingList[j].checked) {
    //         listValues.push(packingList[j].value);
    //     }
    // }

    const obj = new Object();
    obj.name = desName.value;
    obj.details = desDetails;
    obj.catValues = catValues;
    // obj.listValues = listValues;

    var jsonText = JSON.stringify(obj);

    var form = new FormData();

    form.append("path", desImage.files[0]);
    form.append("otherDetails", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Insertion Success", "success");
                desName.value = "";
                desDetails = "";
                catValues = [];
                listValues = [];
            } else {
                swal("", text, "error")
            }
        }
    }
    request.open("POST", "addDestinationProcess.php", true);
    request.send(form);
}

// check session object
function validateSessionObject(uID) {
    if (uID == 0) {
        window.location = "login.php";
    } else {
        let modal = new bootstrap.Modal(document.getElementById('client-rvw-model'));
        modal.show();
    }
}


// submit client review
function submitClientRvw() {
    var country = document.getElementById("country");
    var message = document.getElementById("review-msg");

    var form = new FormData();
    form.append("country", country.value);
    form.append("message", message.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == "success") {
                swal("", "Thanks for sharing your experience...", "success").then(() => {
                    location.reload();
                });
            } else {
                swal("", request.responseText, "error");
            }
        }
    }
    request.open("POST", "submitReview.php", true);
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
                swal("", "Insertion success", "success");
            } else {
                swal("", text, "error");
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
                swal("", "Successfully updated", "success");
            } else {
                swal("", text, "error");
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
                swal("", "Insertion success", "success");
            } else {
                swal("", text, "error");
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
                swal("", "Updated successfully", "success");
            } else {
                swal("", text, "error");
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
                swal("", "Insertion Success", "success");
            } else {
                swal("", text, "error");
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
                swal("", "Successfully updated", "success");
            } else {
                swal("", text, "error");
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
                swal("", "Status updated", "success");
            } else {
                swal("", text, "error");
            }
        }
    }
    request.open("GET", "updatePackageValidity.php?pID=" + pID + "&status=" + status, true);
    request.send();
}

// check the tour package availability from the client-side
function checkPackageAvailability() {
    var noOfMembers = document.getElementById("booking-members");
    var date = document.getElementById("checking-date");

    var form = new FormData();
    form.append("noOfMembers", noOfMembers.value);
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
                    swal("", "Your Booking is now pending for confirmation to make Payment", "success").then(() => {
                        window.location = 'traveler-profile.php';
                    });
                } else {
                    swal("", text, "error");
                }
            }
        }
        request.open("POST", "bookingProcess.php", true);
        request.send(form);
    } else if ("No") {
        swal("", "Thing package is not avalable on " + date.value, "warning");
    } else {
        swal("", "Check the availability first", "warning");
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
                    swal("", "Status Updates", "success");
                } else {
                    swal("", text, "error");
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
                swal("", "Comment added", "success");
                comment.value = "";
            } else {
                swal("", text, "error");
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
function manageDriverVehicle(mID, secId) {
    var memberID = mID;
    var vehicleID = document.getElementById("vehicle-sec-" + secId + "-" + mID);

    var form = new FormData();
    form.append("memberID", memberID);
    form.append("vehicleID", vehicleID.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Vehicle assign success", "success");
            } else {
                swal("", text, "error");
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
                swal("", "Package assigned", "success");
            } else {
                swal("", text, "error");
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
                swal("", "Promotion added", "success").then(() => {
                    window.location = 'add-promotion.php';
                });
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
    var promoId = document.getElementById("promo-id").innerText;
    var packageIdList = document.getElementsByName("selection");
    var selectedPackageList = [];

    for (var x = 0; x < packageIdList.length; x++) {
        if (packageIdList[x].checked) {
            selectedPackageList.push(packageIdList[x].value);
        }
    }

    if (selectedPackageList.length > 0) {
        document.getElementById("selectedIdList-" + promoId).innerHTML = selectedPackageList.join(", ");
    } else {
        swal("", "Select packages", "warning");
    }
}

// assign promotions with tour packages - database intercation
function assignPackagePromo(promoID) {
    var promoID = promoID;
    var packageIdList = document.getElementById("selectedIdList-" + promoID).innerText;

    var packageIds = packageIdList.split(", ").map(id => id.trim());

    var dataObject = new Object();
    dataObject.promoID = promoID;
    dataObject.packageIds = packageIds;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Assigned success", "success");
            } else {
                swal("", text, "error");
            }
        }
    };
    request.open("POST", "assignPromoPackage.php", true);
    request.send(form);
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

// assign one vehicle for one booking
function setVehicleBooking(bookingId) {
    var bookingId = bookingId;
    var vehicleList = document.getElementsByName("available-vehicle");
    var assignedVehicleId;

    for (var x = 0; x < vehicleList.length; x++) {
        if (vehicleList[x].checked) {
            assignedVehicleId = vehicleList[x].value;
        }
    }

    var dataObject = new Object();
    dataObject.bookingId = bookingId;
    dataObject.assignedVehicleId = assignedVehicleId;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var text = request.responseText;
            if (text == "success") {
                swal("", "Assigned success", "success");
            } else {
                swal("", text, "error");
            }
        } else {
            swal("", "Something went wrong...", "error");
        }
    }
    request.open("POST", "setVehicleProcess.php", true);
    request.send(form);
}

// image preview 
function previewImage() {
    // Get elements
    const previewIcon = document.querySelector('.preview-icon');
    const modal = document.getElementById('imagePreviewModal');
    const modalImage = document.getElementById('previewImage');
    const largeImage = document.getElementById('large-image');
    const closeModal = document.querySelector('.close');

    // Open modal with the large image
    previewIcon.addEventListener('click', () => {
        modal.style.display = 'block';
        modalImage.src = largeImage.src;
    });

    // Close modal
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside the image
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// set the large image by small images
function setImage(smImageId) {
    var smImageSrc = document.getElementById(smImageId).src;
    document.getElementById("large-image").src = smImageSrc;
}

// generate full report
function generateFullReport() {
    var startDate = document.getElementById("full-report-st-date");
    var endDate = document.getElementById("full-report-ed-date");

    // Check if the elements exist and have values
    if (!startDate || !endDate || !startDate.value || !endDate.value) {
        swal("", "Please select both start and end dates.", "warning");
        return;
    }

    var form = new FormData();
    form.append("startDate", startDate.value);
    form.append("endDate", endDate.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            if (request.status === 200) {
                // Parse the JSON data
                var response = JSON.parse(request.responseText);

                if (response.html) {
                    document.getElementById("full-report-section").innerHTML = response.html;
                }

                if (response.chartData && response.chartData.packageNameList && response.chartData.packageBookingCountList) {
                    // call for displaying bar chart
                    displayHardcodedChartForFullReport(
                        response.chartData.packageNameList,
                        response.chartData.packageBookingCountList
                    );

                } else {
                    console.error("Invalid data structure in response - Bar Chart.");
                }

                if (response.groupedChartData.months && response.groupedChartData.incomeData && response.groupedChartData.expenseData) {
                    // call for displaying grouped bar chart
                    displayGroupedBarChartForFullReport(
                        response.groupedChartData.months,
                        response.groupedChartData.incomeData,
                        response.groupedChartData.expenseData
                    );
                }
            } else {
                swal("", "Failed to generate the report. Please try again.", "error");
            }
        }
    };
    request.open("POST", "generateFulReportProcess.php", true);
    request.send(form);
}

// export html content to a PDF file
async function exportToPdf() {
    const element = document.getElementById('full-report-section');
    html2pdf().from(element).save('full-report-RomaRadience.pdf');

    swal("", "Downloaded", "success");
}

// visual bar charts

// bar chart for full report
function displayHardcodedChartForFullReport(packageNameList, packageBookingCountList) {
    const canvas = document.getElementById("full-report-myChart");
    const ctx = canvas.getContext("2d");
    canvas.height = 100;

    const barChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: packageNameList,
            datasets: [{
                label: "Booking count",
                data: packageBookingCountList,
                backgroundColor: 'rgba(14, 151, 172, 0.4)',
                borderColor: 'rgb(9, 78, 88)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Package Booking Counts'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// grouped bar chart for full report
function displayGroupedBarChartForFullReport(months, incomeData, expenseData) {
    const ctx = document.getElementById('full-report-groupChart').getContext('2d');
    const groupedBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months, // Dynamically set months from the response
            datasets: [{
                    label: 'Profit (in USD)',
                    data: incomeData.map((income, index) => income - expenseData[index]), // Calculate profit dynamically
                    backgroundColor: 'rgba(14, 151, 172, 0.4)',
                    borderColor: 'rgb(9, 78, 88)',
                    borderWidth: 1,
                },
                {
                    label: 'Expenses (in USD)',
                    data: expenseData, // Set expenses from the response
                    backgroundColor: 'rgba(8, 91, 104, 0.43)',
                    borderColor: 'rgb(2, 24, 27)',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Amount (in USD)',
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: 'Months',
                    },
                },
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: $${context.raw.toLocaleString()}`;
                        },
                    },
                },
            },
        },
    });
}


// bar chart for reports
function barChartForReporting() {
    const canvas = document.getElementById('myChart');
    const ctx = canvas.getContext('2d');

    canvas.height = 100;

    // get the real data from the database
    var dataObject = new Object();
    dataObject.fromDate = "";
    dataObject.toDate = "";

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {

            try {
                const convertedObject = JSON.parse(request.responseText);

                const pieChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: convertedObject.packageNameList,
                        datasets: [{
                            label: 'Booking count',
                            data: convertedObject.packageBookingCountList,
                            backgroundColor: 'rgba(14, 151, 172, 0.4)',
                            borderColor: 'rgb(9, 78, 88)',
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
            } catch (e) {
                console.error("Error parsing server response:", e.message);
            }
        }
    };
    request.open("POST", "fetch-Realdata-bar-Process.php", true);
    request.send(form);
}

// bar chart
function displayHardcodedChart() {
    const canvas = document.getElementById('myChart');
    const ctx = canvas.getContext('2d');

    canvas.height = 500;

    // get the real data from the database
    var dataObject = new Object();
    dataObject.fromDate = "";
    dataObject.toDate = "";

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {

            try {
                const convertedObject = JSON.parse(request.responseText);

                const pieChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: convertedObject.packageNameList,
                        datasets: [{
                            label: 'Booking count',
                            data: convertedObject.packageBookingCountList,
                            backgroundColor: 'rgba(14, 151, 172, 0.4)',
                            borderColor: 'rgb(9, 78, 88)',
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
            } catch (e) {
                console.error("Error parsing server response:", e.message);
            }
        }
    };
    request.open("POST", "fetch-Realdata-bar-Process.php", true);
    request.send(form);
}

// line chart
function displayLineChart() {
    var dateFrom = document.getElementById("date-from");
    var dateTo = document.getElementById("date-to");
    const canvas = document.getElementById('lineChart');
    const ctx = canvas.getContext('2d');

    // Set the canvas size to 0 (hidden state) initially
    canvas.style.width = "800px";
    canvas.style.height = "400px";

    var dataObject = new Object();
    dataObject.dateFrom = dateFrom.value;
    dataObject.dateTo = dateTo.value;

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            try {
                // Parse the server's JSON response
                var response = JSON.parse(request.responseText);

                // Validate response data
                if (response.error) {
                    console.error(response.error);
                    swal("", response.error, "warning");
                    return;
                }

                const monthNames = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];

                const monthYearLabels = response.monthList.map(item => {
                    const [year, month] = item.split('-'); // Assume format is "YYYY-MM"
                    return `${monthNames[parseInt(month, 10) - 1]} ${year}`; // Convert month and add year
                });

                // Dynamically set canvas size (e.g., 800px by 400px)
                canvas.width = 800;
                canvas.height = 400;

                const lineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: monthYearLabels, // Use "Month Year" labels
                        datasets: [{
                            label: 'Monthly Customers',
                            data: response.monthlyBookingCountList, // Use booking counts
                            backgroundColor: 'rgba(14, 151, 172, 0.4)',
                            borderColor: 'rgb(9, 78, 88)',
                            borderWidth: 2,
                            fill: true // Fill the area under the line
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
            } catch (e) {
                console.error("Error processing response: ", e.message);
            }
        }
    }
    request.open("POST", "salesTrackingProcess.php", true);
    request.send(form);
}


// income and expences bar chart
function displayGroupedBarChart() {
    const canvas = document.getElementById('groupedBarChart');
    const ctx = canvas.getContext('2d');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            // Parse the response data
            const responseData = JSON.parse(request.responseText);

            // Validate the response data structure
            if (responseData && responseData.monthList && responseData.incomeList && responseData.expenseList) {
                // Create the chart
                const groupedBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: responseData.monthList, // Dynamic month labels from the response
                        datasets: [{
                                label: 'Income (in LKR)',
                                data: responseData.incomeList, // Income data
                                backgroundColor: 'rgba(14, 151, 172, 0.4)',
                                borderColor: 'rgb(9, 78, 88)',
                                borderWidth: 1
                            },
                            {
                                label: 'Expenses (in LKR)',
                                data: responseData.expenseList, // Expense data
                                backgroundColor: 'rgba(8, 91, 104, 0.43)',
                                borderColor: 'rgb(2, 24, 27)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Amount (in USD)'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Months'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            tooltip: {
                                enabled: true
                            }
                        }
                    }
                });
            } else {
                console.error('Invalid data structure received:', responseData);
            }
        }
    };

    // Send GET request to fetch data
    request.open("GET", "fetchExpenceIncomeData.php", true);
    request.send();
}



// display pie chart
function displayPieChart() {
    var fromDate;
    var toDate;
    const canvas = document.getElementById('pie-chart');
    const ctx = canvas.getContext('2d');

    canvas.height = 300;

    // get the real data from the database
    var dataObject = new Object();
    dataObject.fromDate = "";
    dataObject.toDate = "";

    var jsonText = JSON.stringify(dataObject);

    var form = new FormData();
    form.append("jsonText", jsonText);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {

            try {
                const convertedObject = JSON.parse(request.responseText);

                const pieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: convertedObject.packageNameList,
                        datasets: [{
                            label: 'Booking Count',
                            data: convertedObject.packageBookingCountList,
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)',
                                '#605EA1',
                                '#CA7373',
                                '#CC2B52',
                            ],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });
            } catch (e) {
                console.error("Error parsing server response:", e.message);
            }
        }
    };
    request.open("POST", "fetch-Realdata-Pie-Process.php", true);
    request.send(form);
}