<?php ob_start(); ?>
	<h2>Войти в систему</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="connexion">
		<div>
			<br/>
			<form action="" method="post">
				<table>
					<tr>
						<td><p style="font-weight:bold; color: #DA2C38"><?= $error ?></p></td>
					</tr>
					<tr>
						<td><input type="text" name="login" placeholder="Имя пользователя"></td>
					</tr>
					<tr>
						<td><input type="password" name="passwd" placeholder="Пароль"></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Войти"</td>
					</tr>
					<tr>
						<td><br/><hr></td>				
					</tr>
					<tr>
						<td><p><a href="forgotten_pass.php">Забыл пароль?</a></p></td>
					</tr>
				</table>
			</form>
			<br/>
		</div>
		<br />
		<div>
			<p>У вас уже есть аккаунт? <a href="subscription.php">Зарегистрироваться</a></p>
		</div>
	</div>
	<br />
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>