<?php
/** @var mysqli $db */

require_once "includes/database.php";

if (isset($_POST['submit'])) {
    // Get the record from the database result
    $boxerID = mysqli_escape_string($db, $_POST['id']);
    $query = "SELECT * FROM boxers WHERE id = '$boxerID'";
    $result = mysqli_query($db, $query);

    $boxer = mysqli_fetch_assoc($result);

    $query = "DELETE FROM boxers WHERE id = '$boxerID'";
    mysqli_query($db, $query);

    mysqli_close($db);

    header("Location: index.php");
    exit;

} else if (isset($_GET['id']) || $_GET['id'] != '') {
    //Retrieve the GET parameter from the 'Super global'
    $boxer = mysqli_escape_string($db, $_GET['id']);

    //Get the record from the database result
    $query = "SELECT * FROM boxers WHERE id = '$boxer'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
        $boxer = mysqli_fetch_assoc($result);

    } else {
        header('Location: index.php');
        exit;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete - <?= $boxer['name'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container px-4">
<h2 class="title mt-4">Delete - <?= $boxer['name'] ?></h2>
    <div class="container px-4" action="" method="post"> </div>
<form class="column is-6" action="" method="post">
    <p>
        Weet u zeker dat u het album "<?= $boxer['name'] ?>" wilt verwijderen?
    </p>
    <input type="hidden" name="id" value="<?= $boxer['id'] ?>"/>
    <div class="field-body">
        <button class="button is my-red mt-4" type="submit" name="submit">Verwijderen</button>
    </div>
    <a class="button mt-4" href="index.php">&laquo; Go back to the fighter's</a>


</div>
</form>
</body>
</html>
