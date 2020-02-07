<?php ob_start(); ?>
	<h2>Регистрация</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="connexion">
		<div>
			<br/>
			<form action="" method="post">
				<table>
					<tr>
						<td><p>Зарегистрируйтесь, чтобы делиться своими фотографиями с друзьями</p></td>
					</tr>
					<tr>
						<td><hr></td>				
					</tr>
					<tr>
						<td><p style="font-weight:bold; color: #DA2C38"><?= $error ?></p></td>
					</tr>
					<tr>
						<td><input type="text" name="login" placeholder="Имя пользователя"></td>
					</tr>
					<tr>
						<td><input type="text" name="mail" placeholder="Элетронная почта"></td>
					</tr>
					<tr>
						<td><input id="password" type="password" name="passwd" placeholder="Пароль"></td>
					</tr>
					<tr>
						<td id="pass_security" style="display:none; text-align:left; padding-left:10%;">Ваш пароль должен содержать:<br/>
							- не менее 8 символов<br/>
							- число<br/>
							- верхний и нижний регистр</td>
					</tr>
					<tr>
						<td><input type="password" name="passwd2" placeholder="Подтверждение пароля"></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Зарегистрироваться"></td>
					</tr>
				</table>
			</form>
			<br/>
		</div>
		<br />
		<div>
			<p>Есть ли у вас аккаунт? <a href="connexion.php">Войти</a></p>
		</div>
	</div>
	<br />

<script src="./public/js/connect.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>