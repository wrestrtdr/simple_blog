<?
	session_start();
	require_once "admin/db_connect.php";
					$row_id = $_GET['row'];
				$usr = $_SESSION['user_id'];
			$delete_query = "DELETE FROM fav WHERE note_id = '$row_id' AND user_id = '$usr'";
			mysql_query($delete_query);
			//header("Location:index.php");
?>