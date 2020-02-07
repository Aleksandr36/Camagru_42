<?php

session_start();

include ("CamagruModel.php");
include ("../config/database.php");


if ($_GET['page'] == 'password')
{
    if (empty($_GET['mail']))
	    $_SESSION['error'] = "Не заполнено поле";
    else    
    {
        if(!ft_mail_exist($_GET['mail']))
        {
            ft_retrieve_mail($_GET['mail']);
            $_SESSION['error'] = 'Письмо было только что отправлено<br/>'.$_GET['mail'];
        }
        else
            $_SESSION['error'] = 'Этой электронной почты не существует';
    }

    $page = "forgotten_pass.php";
}

if ($_GET['page'] == 'new_password')
{
    if (empty($_GET['new_pass']) || empty($_GET['new_pass_2']) || empty($_GET['login']))
    {
        $_SESSION['error'] = "Не заполненое поле";
        $page = "reload";
    }
    else
    {
        if ($_GET['new_pass'] != $_GET['new_pass_2'])
        {
            $_SESSION['error'] = "Пароли не совпадают";
            $page = "reload";
        }
        else if (password_secure($_GET['new_pass']))
        {
            ft_mod_pass($_GET['login'], $_GET['new_pass']);
            $key = md5(microtime(TRUE)*100000);
            ft_mod_profile($_GET['login'], $key, 'activation_key');
            $_SESSION['error'] = "Пароль изменен";
            $page = "connexion.php";
        }
        else
            $page = "reload";
    }
}

echo json_encode($page);

?>