<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($name === "") {
    $errors['name'] = 'Name cannot be empty';
}
if ($country === "") {
    $errors['country'] = 'Country cannot be empty';
}
if ($style === "") {
    $errors['style'] = 'Style cannot be empty';
}
if ($weightclass === "") {
    $errors['weightclass'] = 'Weight Class cannot be empty';
}
// this error message wil overwrite the previous error when year is empty
if ($wins === "") {
    $errors['wins'] = 'Wins cannot be empty';
}
if (!is_numeric($wins) || $wins < 1) {
    $errors['wins'] = 'Wins must be a higher than 0';
}
