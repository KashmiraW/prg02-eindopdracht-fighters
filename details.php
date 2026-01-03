<?
/** @var mysqli $db */

//Check if the GET parameter 'id' exists and is not empty
if (!isset($_GET['id']) || $_GET['id'] == '') {
    // redirect to index.php
    header('Location: index.php');
    exit;
}

//Require database in this file
require_once "includes/database.php";

//Retrieve the GET parameter from the 'Super global'
$boxer = mysqli_escape_string($db, $_GET['id']);

//Get the record from the database result
$query = "SELECT * FROM boxers WHERE id = $boxer";
$result = mysqli_query($db, $query);
//Check if db returned exactly one result
if (mysqli_num_rows($result) != 1) {
    // redirect when db returns no result
    header('Location: index.php');
    exit;
}

$boxer = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <title>Details - <?= $boxer['name'] ?></title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4"><?= $boxer['name'] ?></h1>
    <section class="content">
        <ul>
            <li>Style: <?= $boxer['style'] ?></li>
            <li>Weightclass: <?= $boxer['weightclass'] ?></li>
            <li>Wins: <?= $boxer['wins'] ?></li>
        </ul>
    </section>
    <div>
        <a class="button mt-4" href="index.php">&laquo; Go back to the fighter's</a>

    </div>
</div>
</body>
</html>