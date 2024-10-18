<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Place</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                <div class="row">
                    <div class="col-12 mt-3">
                        <center>
                            <h4>Add New Place</h4>
                            <hr>
                        </center>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-6">
                                <span>Name of the Destination:</span>
                            </div>
                            <div class="col-6">
                                <input type="text" class="input w-100" id="des-name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <span>Destination Categories: <br> (Select)</span>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <?php
                                    $categoryResultSet = Database::search("SELECT * FROM `destination_category`");
                                    $categoryNumRows = $categoryResultSet->num_rows;
                                    if ($categoryNumRows > 0) {
                                        for ($x = 0; $x < $categoryNumRows; $x++) {
                                            $categoryData = $categoryResultSet->fetch_assoc();
                                    ?>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input type="checkbox" name="categories[]" value="<?php echo $categoryData['id']; ?>">
                                                    </div>
                                                    <div class="col-10">
                                                        <p><?php echo $categoryData["name"]; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-2">
                                                    <input type="checkbox" name="packingList[]" value="<?php echo $categoryData['id']; ?>">
                                                </div>
                                                <div class="col-10">
                                                    <label for=""><i>No categories available</i></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <span>Packing Items: <br> (Select)</span>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <?php
                                    $itemResultSet = Database::search("SELECT * FROM `packing_list`");
                                    $itemNumRows = $itemResultSet->num_rows;
                                    if ($itemNumRows > 0) {
                                        for ($x = 0; $x < $itemNumRows; $x++) {
                                            $itemData = $itemResultSet->fetch_assoc();
                                    ?>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <input type="checkbox" name="packingList[]" value="<?php echo $itemData['id']; ?>">
                                                <label for=""><?php echo $itemData["list_item"]; ?></label>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <p><i>No items...</i></p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <span>About:</span>
                            </div>
                            <div class="col-6">
                                <textarea name="desDetails" id="desDetails" rows="10" class="w-100"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <span>Thumbnail:</span>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <input class="form-control w-100" type="file" id="formFile" accept=".png, .jpg, .jpeg" onclick="imagePreview();">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <center><img alt="" id="des-image" style="width: 300px; height: 400px; object-fit: cover;" class="img-fluid rounded-2" src="resources/images/default -image.svg"></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-6">
                                <center>
                                    <button class="w-50">Clear</button>
                                </center>
                            </div>
                            <div class="col-6">
                                <center>
                                    <button class="w-50" onclick="sendDestinationDetails();">Add</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

    <!-- replace the text area by CKEDITOR -->
    <script>
        CKEDITOR.replace('desDetails');
    </script>
</body>

</html>