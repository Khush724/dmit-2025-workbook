<?php

$user_date = '2005-04-22s';

function is_it_a_date($user_date)
{
    $date_format = 'Y-m-d';
    $parsed_date = date_parse_from_format($date_format, $user_date);
    // var_dump($parsed_date);
    $errors = $parsed_date['error_count'];

    if ($errors == 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

$valid_date = is_it_a_date($user_date);
if($valid_date) {
    $result = can_you_enter($user_data);
}
else {
    $result = "Please Enter A Valid Date";
}


function can_you_enter($user_date)
{
    $converted_user_data = strtotime($user_date);
    $today = strtotime(date('Y-m-d'));
    $age = floor(abs($today - $converted_user_data) / (365.25 * 24 * 60 * 60));

    $age_of_majority = 18;

    if ($age >= $age_of_majority)
        $result = 'You can enter since you are an adult.';
    else
        $result = 'You are a baby. You cannot come in.';

    return $result;
}

// $user_data = "2022-03-23";
// $today = date('Y-m-d');
// $converted_today = strtotime($today);
// $converted_user_data = strtotime($user_data);
// $age = abs($converted_today - $converted_user_data);
// $ageInYears = $age / (365.25 * 24 * 60 * 60);
// $ageInt = floor($ageInYears);

// $age_of_majority = 18;

// if ($ageInt >= $age_of_majority)
//     echo 'You can enter since you are an adult.';
// else
//     echo 'You are a baby. You cannot come in.';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?= $result ?>
</body>

</html>