<?php
/** @var mysqli $db */

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "includes/database.php";
    require_once "includes/image-helpers.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $name = mysqli_escape_string($db, $_POST['name']);
    $country = mysqli_escape_string($db, $_POST['country']);
    $style = mysqli_escape_string($db, $_POST['style']);
    $weightclass = mysqli_escape_string($db, $_POST['weight class']);
    $wins = mysqli_escape_string($db, $_POST['wins']);

    //Require the form validation handling
//    require_once "includes/form-validation.php";

    //Special check for add form only
    if ($_FILES['image']['error'] == 4) {
        $errors['image'] = 'Image cannot be empty';
    }

    if (empty($errors)) {
        //Store image & retrieve name for database saving
        $image = addImageFile($_FILES['image']);

        //Save the record to the database
        $query = "INSERT INTO albums (name, country, style, weightclass, wins, image)
                  VALUES ('$name', '$country', '$style', $weightclass, $wins, '$image')";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Top 10 Best in Boxing create</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
</head>
<body>
<h1>Add new fighter</h1>
<?php if (isset($errors['db'])) { ?>
    <div><span class="errors"><?= $errors['db']; ?></span></div>
<?php } ?>

<!-- enctype="multipart/form-data" no characters will be converted -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="<?= isset($name) ? htmlentities($name) : '' ?>"/>
        <span class="errors"><?= isset($errors['name']) ? $errors['name'] : ''?></span>
    </div>
    <div class="data-field">
        <label for="country">Country</label>
        <input id="country" type="text" name="country" value="<?= isset($country) ? htmlentities($country) : '' ?>"/>
        <span class="errors"><?= isset($errors['country']) ? $errors['country'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="style">`Style</label>
        <input id="style" type="text" name="style" value="<?= isset($style) ? htmlentities($style) : '' ?>"/>
        <span class="errors"><?= isset($errors['style']) ? $errors['style'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="weightclass">Weight Class</label>
        <input id="weightclass" type="text" name="weightclass" value="<?= isset($weightclass) ? htmlentities($weightclass) : '' ?>"/>
        <span class="errors"><?= isset($errors['weightclass']) ? $errors['weightclass'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="wins">Wins</label>
        <input id="wins" type="number" name="wins" value="<?= isset($wins) ? htmlentities($wins) : '' ?>"/>
        <span class="errors"><?= isset($errors['wins']) ? $errors['wins'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="image">Image</label>
        <input type="file" name="image" id="image"/>
        <span class="errors"><?= isset($errors['image']) ? $errors['image'] : '' ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
