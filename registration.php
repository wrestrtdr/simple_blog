<?
session_start();
require_once "admin/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>будинок тепих вітрів</title>
	<link rel="stylesheet" href="css/style.css">		
</head>
<body>
	<div id="container">
		<div id="container-inner">
			<div id="head">
				<div id="logo">
					<a href="index.php" class="logo">будинок теплих вітрів	</a>
				</div>
				<div id="menu">
					<ul>
						<?
						if ($_SESSION['privileg'] == '1') 
						{
							echo '<li><a href="new_note.php">Новий запис</a></li>';
						}
						if (isset($_SESSION['login'])) 
						{
							echo '<li><a href="stat.php">Улюблені записи</a></li>';
							echo '<li><a href="logout.php">Вийти</a></li>';
						}
						else
							echo '<li><a href="registration.php">Ввійти</a></li>';
						?>
					</ul>

				</div>
			</div>
			<div id="content">
					<?

		if (isset($_POST['register'])) 
		{
			$login=$_POST['login'];
			$pass=$_POST['password'];
			$rpass=$_POST['repassword'];

			$res = mysql_query("SELECT count(id) from users WHERE login = '$login'");
			$row = mysql_fetch_row($res);

			if ($pass != $rpass) 
			{
				echo "Паролі не співпадають";
			}
				elseif ($row[0] > 0)
				{
					echo "Логін вже зайнятий";
				}
					elseif (strlen($pass) < 6)
						{
							echo "Мінімальна довжина паролю - 6 символів";
						}
							else
							{
								$pass = md5($pass);
								$req = "INSERT INTO users(id,login,password,privileg) VALUES('','$login','$pass','0')"; 
								mysql_query($req);
							}
		}


		if (isset($_POST['enter'])) 
		{
			$elogin = $_POST['elogin'];
			$epass = md5($_POST['epassword']);

			$query = mysql_query("SELECT * FROM users WHERE login = '$elogin'");
			$user_arr = mysql_fetch_array($query);

			if ($user_arr['password'] == $epass) 
			{
				$_SESSION['login'] = $elogin;
				$_SESSION['privileg'] = $user_arr['privileg'];
				$_SESSION['user_id'] = $user_arr['id'];
				echo $_SESSION['login'];
				echo '<script type="text/javascript">
						window.location = "index.php"
						</script>';
			}			
		}
		else
		{
			echo "";
		}		
	?>	
		<div id="rigblock">
	<form action="registration.php" method="post">
		<input type="login" name="login" placeholder="Логін"><br>
		<input type="password" name="password" placeholder="Пароль"><br>
		<input type="password" name="repassword" placeholder="Повторіть пароль"><br>
		<input type="submit" name="register" value="Зареєструватись"><br>
	</form>			
		</div>
		<div id="lefblock">
	<form action="registration.php" method="post">
		<input type="login" name="elogin" placeholder="Логін"><br>
		<input type="password" name="epassword" placeholder="Пароль"><br>
		<input type="submit" name="enter" value="Вхід"><br>
	</form>					
		</div>
		
			</div>			
		</div>
	</div>
</body>
</html>
<!-- 
admin
159357	
-->