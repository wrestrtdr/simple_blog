<?
		$db_host='localhost';
		$db_name='kpiz';
		$db_user='admin';
		$db_pass='159357';

		@mysql_connect($db_host,$db_user,$db_pass);
		@mysql_select_db($db_name);

		mysql_query ("set_client='utf8'");
		mysql_query ("set character_set_results='utf8'");
		mysql_query ("set collation_connection='utf8_general_ci'");
		mysql_query ("SET NAMES utf8");	
?>
