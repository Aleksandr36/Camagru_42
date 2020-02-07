<?php ob_start(); ?>
	<h2>Забытый пароль</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="connexion">
		<div>
			<br/>
				<table>
					<tr>
						<td><p>Укажите свой адрес электронной почты, чтобы мы могли отправить вам ссылку на инициализацию.</p></td>
					</tr>
					<tr>
						<td><hr></td>				
					</tr>
					<tr>
						<td><p style="font-weight:bold; color: #DA2C38"><?= $error ?></p></td>
					</tr>
					<tr>
						<td><input class="input" type="text" name="mail" placeholder="Адрес электронной почты"></td>
					</tr>
					<tr>
						<td><input onclick="retrieve_pass()" id="submit_form" class="pass" type="submit" name="submit" value="Повторите инициализацию вашего пароля"</td>
					</tr>
				</table>
			<br/>
		</div>
		<br/>
		<div>
			<p>Ты знаешь свой пароль? <a href="connexion.php">Войти</a></p>
		</div>
	</div>
	<br />

<script src="./public/js/connect.js"></script>
<?php $form = ob_get_clean(); ?>

<?php ob_start(); ?>
	<h2>Забыли пароль</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="connexion">
		<div>
			<br/>
				<table>
					<tr>
						<td><p>Введите новый пароль</p></td>
					</tr>
					<tr>
						<td><hr></td>				
					</tr>
					<tr>
						<td><p style="font-weight:bold; color: #DA2C38"><?= $error ?></p></td>
					</tr>
					<input type="text" name="login" value=<?= $_GET['log']?> hidden>
					<tr>
						<td><input id="password" class="input" type="password" name="pass" placeholder="Пароль"></td>
					</tr>
					<tr>
						<td id="pass_security" style="display:none; text-align:left; padding-left:10%;">Ваш пароль должен содержать:<br/>
						- не менее 8 символов<br/>
						- число<br/>
						- верхний и нижний регистр</td>
					</tr>
					<tr>
						<td><input class="input" type="password" name="pass_2" placeholder="Подтверждение пароля"></td>
					</tr>
					<tr>
						<td><input onclick="new_pass()" id="submit_form" type="submit" name="submit" value="Подтвердить"</td>
					</tr>
				</table>
			<br/>
		</div>
		<br/>
		<div>
			<p>Ты знаешь свой пароль? <a href="connexion.php">Войти</a></p>
		</div>
	</div>
	<br />

<script src="./public/js/connect.js"></script>
<script>
	var password = document.getElementById("password")
if (password){
    password.addEventListener('input', function(){
        document.getElementById("pass_security").style.display = "block"
    })
}
</script>
<?php $retrieve = ob_get_clean(); ?>

<?php 
	if (isset($_GET['key']) && isset($_GET['log']))
		$content = $retrieve;
	else
		$content = $form;
?>

<?php require('view/template.php'); ?>