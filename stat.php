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
							echo '<li><a href="logout.php">Вийти</a></li>';
							echo '<li><a href="stat.php">Улюблені записи</a></li>';
						}
						else
							echo '<li><a href="registration.php">Ввійти</a></li>';
						?>
					</ul>

				</div>
			</div>
			<div id="content">
				<?
					$usr = $_SESSION['user_id'];
					$query = "SELECT notes.created, notes.title, notes.article, notes.id 
								FROM fav 
								LEFT JOIN notes ON notes.id = fav.note_id
								WHERE fav.user_id = '$usr'
								";
					$result = mysql_query($query);
					mb_internal_encoding('UTF-8');
					//print_r($rs = mysql_fetch_array($result));
					while ($row = mysql_fetch_array($result)) 
					{
						?>
							<div class="post">
								<div class="post_inner">
									<div class="titl"><p class="title"><a href="full_post.php? row=<?php echo $row['id'];?>"><?php echo $row[title];echo'<br />';?></a></p></div>
										<?
											?>
										<div class="post_content"><?
												$row2 = mb_substr($row[article], 0, 500);
												echo $row2;
											?></div>
											<?
											?>
											<div class="post_date"><?echo $row[created];echo'<br />';?></div>
											<?
											if ($_SESSION['privileg'] == '1') 
										{
										?>
									<div class="post_cont"><a class='dell' href="delete_note.php? row=<?php echo $row[id];?>">Видалити запис</a>
									<a class='reddd' href="edit_note.php? row=<?php echo $row[id];?>">Редагувати запис</a></div>
								
							<?
						}
						?>		</div>
							</div><?
						echo'<br />';echo'<br />';		
					}
				?>				
			</div>
		</div>
	</div>
</body>
</html>