<?PHP

function ft_login_exist($login)
{
	$db = db_connect();
	
	$sql = $db->prepare("SELECT * FROM user WHERE login=:login");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return true;
	else
	{
		$_SESSION['error'] = "Это имя пользователя уже существует.";
		return false;
	}
}

function ft_mail_exist($mail)
{
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE mail=:mail");
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return true;
	else
	{
		$_SESSION['error'] = "Пользователь с такой электронной почтой уже существует.";
		return false;
	}
}

function ft_user_new($login, $pass, $mail)
{
	$db = db_connect();
	
	$login = htmlspecialchars($login);
	$pass = htmlspecialchars($pass);
	$mail = htmlspecialchars($mail);
	
	$activation_key = md5(microtime(TRUE)*100000);
	$sql = $db->prepare("INSERT INTO user (login, mail, pass, admin, activation_key) VALUES (:login, :mail, '1', '0', '".$activation_key."')");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	ft_mod_pass($login, $pass);
	ft_activation_mail($login, $mail, $activation_key);
}


function ft_user_del($login)
{
	$db = db_connect();
	$sql = "DELETE FROM user WHERE user.login='".$login."'";
	$db->query($sql);
	$db = null;
}

function ft_activation_mail($login, $mail, $key)
{
	$header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
	$subjet = "Camagru : активировация аккаунта"."\n";
	$link = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$link = str_replace("subscription.php", "", $link);
	$link .='activation.php?log='.urlencode($login).'&key='.urlencode($key);

	$message = "Добро пожаловать в Camagru,"."\n\n";
	$message .="Чтобы активировать свой аккаунт, нажмите на ссылку ниже."."\n\n";
	$message .= $link;
	$message .="\n\n"."---------------"."\n";
	$message .="Это автоматическое письмо, пожалуйста, не отвечайте на него.";
	if ( !mail($mail, $subjet, $message, $header)) 
	{
		$_SESSION['error'] = "Это автоматическое письмо. Пожалуйста, не переходите туда. Произошла ошибка при отправке письма с подтверждением. <br/> Пожалуйста, попробуйте еще раз.";
	}
}

function ft_mod_pass($login, $new_pass)
{
	$db = db_connect();
	$profile = get_profile($login);
	$passwd = ft_hash($profile['id'], $new_pass);
	$sql = $db->prepare("UPDATE user SET pass=:new WHERE login=:login");
	$sql->bindParam(":new", $passwd, PDO::PARAM_STR);
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	$_SESSION['error'] = "Пароль изменен";
	return true;
}

function ft_retrieve_mail($mail)
{
	$db = db_connect();
	$sql = $db->prepare( "SELECT * FROM user WHERE mail=:mail");
	$sql->bindParam(":mail", $mail, PDO::PARAM_STR);
	$sql->execute();
	$profile = $sql->fetch();
	$db = null;

	$link = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$link = str_replace("model/connect.php", "", $link);
	$link .= "forgotten_pass.php?log=".urlencode($profile['login'])."&key=".urlencode($profile['activation_key']);

	$header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
	$subjet = "Camagru : Восстановление пароля\n";

	$message = "Чтобы сменить пароль, нажмите на ссылку ниже."."\n\n";
	$message .= $link;
	$message .="\n"."---------------"."\n";
	$message .="Это автоматическое письмо, пожалуйста, не отвечайте на него.";

	mail($profile['mail'], $subjet, $message, $header);
}

function ft_mod_profile($login,$new_item,$item)
{
	$db = db_connect();

	$login = htmlspecialchars($login);
	$new_item = htmlspecialchars($new_item);

	$sql = $db->prepare("UPDATE user SET ".$item."=:new_item WHERE login=:login");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->bindParam("new_item", $new_item, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	return true;
}

?>
