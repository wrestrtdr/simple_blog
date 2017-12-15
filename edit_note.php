<?
session_start();
require_once "admin/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
					$row_id = $_GET['row'];
					$row = mysql_fetch_array(mysql_query("SELECT * FROM `notes` WHERE id = '$row_id'"));

					$title = $_POST['title'];
					$article =  $_POST['article'];
					$ttt = '123';

					$update_query = "UPDATE notes SET title = '$title', article = '$article' WHERE id = '$row_id'";
					mysql_query($update_query);
					$ttt = $title;
					if ($ttt = $title) 
					{
										echo '<script type="text/javascript">
						window.location = "index.php"
						</script>';
					}
				?>
				<form action="" method="POST">
					<input type="text" name="title" id="title" value="<?php echo $row[title];?>">
					<input type = "hidden" name = "created" id = "created" value = "<?php echo date (" Y-m-d ");?>" />
					<textarea name="article" id="" cols="30" rows="10" id="article"><?php echo $row[article];?></textarea>
					<input type="submit" value="edit_note">
				</form>				
			</div>
		</div>
	</div>
</body>
</html>