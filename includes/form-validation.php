<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($name == "") {
    $errors['artist'] = 'Name cannot be empty';
}
if ($country == "") {
    $errors['country'] = 'Country cannot be empty';
}
if ($style == "") {
    $errors['style'] = 'Style cannot be empty';
}
if ($weightclass == "") {
    $errors['weightclass'] = 'Weight Class cannot be empty';
}
// this error message wil overwrite the previous error when year is empty
if ($wins == "") {
    $errors['wins'] = 'Wins cannot be empty';
}
//if (!is_numeric($tracks)) {
//    $errors['tracks'] = 'Tracks need to be a number';
//}
//if ($tracks > 255) {
//    $errors['tracks'] = 'The amount of tracks must be less then 255';
//}
//// this error message wil overwrite the previous error when tracks is empty
//if ($tracks == "") {
//    $errors['tracks'] = 'Tracks cannot be empty';
//}
