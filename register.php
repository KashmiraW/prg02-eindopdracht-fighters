<?php
$errors = [];

if (isset($_POST['submit'])) {
    /** @var mysqli $db */

    require_once "includes/database.php";

    // Get form data
    $firstName = $_POST['firstName'] ?? '';
    $lastName  = $_POST['lastName'] ?? '';
    $email     = $_POST['email'] ?? '';
    $password  = $_POST['password'] ?? '';

    if ($firstName === "") {
        $errors['firstName'] = 'first name cannot be empty';
    }

    if ($lastName === "") {
        $errors['lastName'] = 'last name cannot be empty';
    }

    if ($email === "") {
        $errors['email'] = 'email cannot be empty';
    }

    if ($password === "") {
        $errors['password'] = 'password cannot be empty';
    }

    if (empty($errors)) {

        // create a secure password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // store the new user in the database
        $query = "INSERT INTO users (first_name, last_name, email, password)
                  VALUES ('$firstName', '$lastName', '$email', '$hash')";

        $result = mysqli_query($db, $query);

        // If query succeeded
        if ($result) {
            header('location: login.php');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="section">
    <div class="container content">
        <h2 class="title">Register With Email</h2>

        <section class="columns">
            <form class="column is-6" action="" method="post">

                <!-- First name -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="firstName">First name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="firstName" type="text" name="firstName"
                                       value="<?= $firstName ?? '' ?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['firstName'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Last name -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="lastName">Last name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="lastName" type="text" name="lastName"
                                       value="<?= $lastName ?? '' ?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['lastName'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="email">Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="email" type="text" name="email"
                                       value="<?= $email ?? '' ?>">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['email'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="password">Password</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="password" type="password" name="password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['password'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is- my-red is-link is-fullwidth" type="submit" name="submit">
                            Register
                        </button>
                    </div>
                </div>

            </form>
        </section>

    </div>
</section>
</body>
</html>


