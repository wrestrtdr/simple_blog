<?
	session_start();
	require_once "admin/db_connect.php";
					$row_id = $_GET['row'];

			$delete_query = "DELETE FROM notes WHERE id = '$row_id'";
			mysql_query($delete_query);
			//header("Location:index.php");
?>