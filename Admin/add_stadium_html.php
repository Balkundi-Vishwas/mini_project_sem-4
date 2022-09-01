<?php

include "option_page.html";

?>

<!DOCTYPE html>
<html>
    <head>

        <title>Add Stadium</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../Shared/style.css">

    </head>
    <body>
        <div class="d-flex justify-content-center align-items-center">
            <form action="add_stadium_php.php" method="post" enctype="multipart/form-data" class="w-25 bg-warning p-4 text-center mt-5 mb-5">
                <div>
                    <h2>Add Stadium</h2>
                    <input type="text" name="sname" placeholder="Enter Stadium Name" class="mt-3 form-control" required>
                    <input type='file' name='simg' id='img' accept='image/*' class='mt-3 form-control' required>
                    <label for='img' class='mt-3 form-control btn btn-primary forlabel'> Add Stadium Image </label>
                    <input type="text" name="address" placeholder="Enter Stadium Address" class="mt-3 form-control" required>
                    <input type="text" name="city" placeholder="Enter Stadium City" class="mt-3 form-control" required>    
                </div>
                <div>
                    <h4 class="mt-3">Seats in Each Division</h4>
                    <input type="number" placeholder="class diamond" name="diamond" min="1" step="1" class="mt-3 form-control" required>
                    <input type="number" placeholder="class gold" name="gold" min="1" step="1" class="mt-3 form-control" required>
                    <input type="number" placeholder="class silver" name="silver" min="1" step="1" class="mt-3 form-control" required>
                </div>
                <input type="submit" value="Add Stadium" class="mt-3 form-control btn btn-success">
            </form>
        </div>

    </body>
</html>