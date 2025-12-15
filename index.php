<?php
/** @var mysqli $db */

//Require DB settings with connection variable
require_once "includes/database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM boxers";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
$boxer = [];
while ($row = mysqli_fetch_assoc($result)) {
    $boxer[] = $row;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>The 10 Best in Boxing</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">The 10 Best in Boxing</h1>
    <h2 class="subtitle mt-4">Overview of my top fighters</h2>
    <hr>
<!--    <header class="hero is-info">-->
<!--        <div class="hero-body">-->
<!--            <p class="title">Music collection</p>-->
<!--            <p class="subtitle">Overview of my top albums</p>-->
<!--        </div>-->
<!--    </header>-->

    <table class="table is-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Country</th>
            <th>Style</th>
            <th>Weight Class</th>
            <th>Wins</th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="6" class="has-text-centered">&copy; Best in Boxing</td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($boxer as $index => $boxer) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $boxer['name'] ?></td>
                <td><?= $boxer['country'] ?></td>
                <td><?= $boxer['style'] ?></td>
                <td><?= $boxer['weightclass'] ?></td>
                <td><?= $boxer['wins'] ?></td>
                <td><a href="details.php?id=<?= $boxer['id'] ?>">Details</a></td>
                <td><a href="delete.php?id=<?=$boxer['id'] ?>">Delete</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <a class="button is-my my-red" href="create.php">Add new fighter</a>
</div>
</body>
</html>
