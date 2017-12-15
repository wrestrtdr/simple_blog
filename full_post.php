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
			<hr>
			<div id="content">
				<?
					//ВИВЕДЕННЯ ПОСТА
					$row_id = $_GET['row'];
					$row = mysql_fetch_array(mysql_query("SELECT * FROM `notes` WHERE id = '$row_id'"));

					?><div class="post_wrapper">
						<div class="post_inner2">
							<div class="post_title">
								<?echo $row[title];echo '<br />';?>
							</div>
							<div class="post_article">
								<?echo $row[article];echo'<br />';?>
							</div>
							<div class="post_date2">
								<?echo $row[created];echo'<br />';?>
							</div>
							<div id="fav">
								

									<?
										$usr = $_SESSION['user_id'];
										$res = mysql_query( 
											"SELECT count(note_id) 
											FROM fav 
											WHERE user_id = '$usr' 
											AND note_id = '$row_id'"
										);
										$roww = mysql_fetch_row($res);									
										//if (isset($_SESSION['login'])) 
										//{

										//}
										if (isset($_SESSION['login'])) 
										{
											echo '<form action="" method="post" class="lv_cmnt ght">
													<input type="submit" name="fav_adddd" value="Улюблене"><br>
													</form>';
										}
										if (isset($_POST['fav_adddd']) and $roww[0] > 0) 
										{
												echo "Запис видалено з улюблених матеріалів";
												$delete_query = "DELETE FROM fav WHERE note_id = '$row_id' AND user_id = '$usr'";
												mysql_query($delete_query);		
								
										}	
										if (isset($_POST['fav_adddd']) and $roww[0] == 0)
										{	
												echo "Запис додано до улюблених матеріалів";
												$delete_query = "INSERT INTO fav (fav_id, note_id, user_id) VALUES ('','$row_id', '$usr')";
												mysql_query($delete_query);
												echo '';									
										} 
									?>

							</div>
						</div>
					</div><?

					//ВИВЕДЕННЯ КОМЕНТАРІВ
					$query = "SELECT * FROM comments WHERE note_id = '$row_id' ORDER BY created ASC";
					$result = mysql_query($query);
					while ($row = mysql_fetch_array($result)) {
						?><div class="commentaries"><?
					?>
						<div class="com_auth"><p class="authndata"><span class="auth"><?echo $row[author];echo'<br />';?></span><span  class="datad"><?echo $row[created];echo'<br />';?></span></p></div>
					<?
					?>
						<div class="com_txt"><?echo $row[comment];echo'<br />';?></div></div>
					<?
					}?><?

					//ДОДАВАННЯ КОМЕНТАРЯ
					if ($_SESSION['privileg'] == '0') 
					{
						echo '<form action="" method="POST" class="lv_cmnt">
								<textarea  name="comment" id="comment" cols="50" rows="10"></textarea><br>
								<input type="submit" value="Відправити">
								</form>';

				$author = $_SESSION['login'];
				$created = date('Y-m-d');
				$comment = $_POST['comment'];

				if (($author)&&($created)&&($comment)) {
					$query = "INSERT INTO comments (id, created, author, comment, note_id) VALUES ('','$created', '$author', '$comment', '$row_id') ";
					mysql_query($query);
				}			
					}
				?>				
			</div>
		</div>
	</div>
</body>
</html>