<?php
/** @var mysqli $db */

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $name = $_POST['name'];
    $country = $_POST['country'];
    $style = $_POST['style'];
    $weightclass = $_POST['weightclass'];
    $wins = $_POST['wins'];

    //Require the form validation handling
    require_once "includes/form-validation.php";

    if (empty($errors)) {
        //Require database in this file & image helpers
        require_once "includes/database.php";

        //Save the record to the database
        $query = "INSERT INTO boxers (name, country, style, weightclass, wins)
                  VALUES ('$name', '$country', '$style', '$weightclass', '$wins')";
        $result = mysqli_query($db, $query);

        //Close connection
        mysqli_close($db);

        // Redirect to index.php
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
    <title>The 10 Best in Boxing - Create</title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">Create new fighter 🥊</h1>

    <section class="columns">
        <form class="column is-6" action="" method="post">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">Name</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="name" type="text" name="name" value="<?= $name ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['name'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="country">Country</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="country" type="text" name="country" value="<?= $country ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['country'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="style">Style</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="style" type="text" name="style" value="<?= $style ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['style'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="weightclass">Weight Class</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="weightclass" type="text" name="weightclass" value="<?= $weightclass ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['weightclass'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="wins">Wins</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="wins" type="text" name="wins" value="<?= $wins ?? '' ?>"/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['wins'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal"></div>
                <div class="field-body">
                    <button class="button is my-red is-fullwidth" type="submit" name="submit">Save</button>
                </div>
            </div>
        </form>
    </section>
    <a class="button mt-4" href="index.php">&laquo; Go back to the fighter's</a>
</div>
</body>
</html>
