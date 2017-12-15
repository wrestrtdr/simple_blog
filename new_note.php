<?
session_start();
require_once "admin/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
					$title = $_POST['title'];
					$created = $_POST['created'];
					$article = $_POST['article'];

					echo $title;

					if (($title)&&($created)&&($article)&&($article <= 3000))
					{
						$query = "INSERT INTO notes (id, created, title, article) VALUES ('','$created', '$title', '$article')";
							mysql_query($query) or die (mysql_error());
						echo '<script type="text/javascript">
							window.location = "index.php"
							</script>';	
					}				
				?>
				<form action="" method="POST" class="new_possst">
					<input type="text" name="title" id="title"><br>
					<input type = "hidden" name = "created" id = "created" value = "<?php echo date (" Y-m-d ");?>" /><br>
					<textarea name="article" id="" cols="80" rows="10" id="article"></textarea><br>
					<input type="submit" value="Додати запис"><br>
				</form>					
			</div>
		</div>
	</div>
</body>
</html>