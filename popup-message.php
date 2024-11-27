<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Message</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="popup" id="popup-1">
        <div class="popup-overlay">
            <div class="popup-content">
                <div class="close-button" onclick="togglePopup();">&times;</div>
                <h1>Title</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Itaque iure id suscipit distinctio magni dicta! Deleniti ea, iure quae repellat enim dicta nesciunt accusantium temporibus aspernatur pariatur, autem odit harum!</p>
            </div>
        </div>
    </div>

    <button onclick="togglePopup();">Show Popup</button>
    <script src="script.js"></script>
</body>

</html>