<?
	session_start();
	require_once "admin/db_connect.php";
					$row_id = $_GET['row'];

			$usr = $_SESSION['user_id'];			
			$delete_query = "INSERT INTO fav (fav_id, note_id, user_id) VALUES ('','$row_id', '$usr')";
			mysql_query($delete_query);
			//header("Location:index.php");
?>