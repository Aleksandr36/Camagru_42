<?php

session_start();

require("model/CamagruModel.php");
include("model/profileModel.php");
include("config/database.php");

$profile = get_profile($_GET['log']);

if ($profile == "" || $profile['activation_key']!= $_GET['key'])
{
    $_SESSION['error'] = "Неверная ссылка для активации";
}

else if ($profile['active'] == 1)
{
    $_SESSION['error'] = "Ваша учетная запись деактивирована";
}

else {
    $_SESSION['error'] = "Ваша учетная запись активирована";
    ft_activate_account($_GET['log']);
}


$error = ft_error();

require('view/activationView.php');

?>