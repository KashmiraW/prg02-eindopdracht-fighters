<?php
/** @var mysqli $db */
require_once "includes/database.php";

$id = mysqli_escape_string($db, $_GET['id']);

$sql = "SELECT * FROM boxers WHERE id = $id";

$result = mysqli_query($db, $sql);
$boxer = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {

    $name  = $_POST['name'];
    $country = $_POST['country'];
    $style   = $_POST['style'];
    $weightclass = $_POST['weightclass'];
    $wins  = filter_input(INPUT_POST, "wins", FILTER_VALIDATE_INT);

    require_once "includes/form-validation.php";

    if (empty($errors)) {

        $sql = "UPDATE boxers SET name ='$name', country = '$country', style = '$style', weightclass = '$weightclass', wins = '$wins' WHERE id = $id";
        $result = mysqli_query($db, $sql);

        if ($result) {
            header('Location: index.php');
            exit;
        }

    }
}

mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>The 10 Best in Boxing Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="container px-4">
<h1 class="title mt-4">Edit "<?= htmlentities($boxer['name'])?>"</h1>

<section class="columns">
<form class="column is-6" action="" method="post" enctype="multipart/form-data">
    <div class="field is-horizontal">
        <div class="field-label is-normal"></div>
        <label class="label" for="name">Name</label>
        <div class="field-label is-normal"></div>
        <input class="input" id="name" type="text" name="name" value="<?= htmlentities($boxer['name']) ?>"/>
        <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
    </div>
    <div class="field is-horizontal">
        <div class="field-label is-normal"></div>
        <label class="label" for="country">Country</label>
        <div class="field-label is-normal"></div>
        <input class="input" id="country" type="text" name="country" value="<?= htmlentities($boxer['country']) ?>"/>
        <span class="errors"><?= isset($errors['country']) ? $errors['country'] : '' ?></span>
    </div>
    <div class="field is-horizontal">
        <div class="field-label is-normal"></div>
        <label class="label" for="style">Style</label>
        <div class="field-label is-normal"></div>
        <input class="input" id="style" type="text" name="style" value="<?= htmlentities($boxer['style']) ?>"/>
        <span class="errors"><?= isset($errors['style']) ? $errors['style'] : '' ?></span>
    </div>
    <div class="field is-horizontal">
        <div class="field-label is-normal"></div>
        <label class="label" for="weightclass">Weightclass</label>
        <div class="field-label is-normal"></div>
        <input class="input" id="weightclass" type="text" name="weightclass" value="<?= htmlentities($boxer['weightclass']) ?>"/>
        <span class="errors"><?= isset($errors['weightclass']) ? $errors['weightclass'] : '' ?></span>
    </div>
    <div class="field is-horizontal">
        <div class="field-label is-normal"></div>
        <label class="label" for="wins">Wins</label>

        <div class="field-label is-normal"></div>
            <input class="input" id="wins" type="number" name="wins" value="<?= htmlentities($boxer['wins']) ?>"/>
            <span class="errors"><?= isset($errors['wins']) ? $errors['wins'] : '' ?></span>
    </div>
    <div class="field is-horizontal">
        <div class="field-label is-normal"></div>
        <div class="field-body">
            <button class="button is my-red is-fullwidth" type="submit" name="submit">Save</button>
        </div>
    </div>

</form>
    </section
<div>
    <a class="button mt-4" href="index.php">&laquo; Go back to the fighter's</a>
</div>
</body>
</html>
