<? define("INC_SCAN","1");

include("options.inc.php");

$user_ip = string_slash($_SERVER[REMOTE_ADDR]);
$content_id = string_slash($_POST[id]);

$error_user_ip = reg_expres($user_ip, 9, 15, "/^[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}$/");
$error_content_id = reg_expres($content_id, 1, 11, "/^[0-9]{1,11}$/");

$content_res = mysql_query("SELECT id FROM content WHERE id='$content_id'",$db);
$content_row = mysql_num_rows($content_res);

if($error_user_ip == true || $error_content_id == true || $content_row == 0)
{
	header("Status: 404 Not Found");
	header("Location: /error.php");
	mysql_close($db);
	exit();
}

$count_res = mysql_query("SELECT user_ip FROM user_like WHERE user_ip=INET_ATON('$user_ip')",$db);
$count_row = mysql_num_rows($count_res);

if($count_row == 0)
{
	$insert_list = "|".$content_id."|,";
	@mysql_query("UPDATE content SET the_like=the_like+1 WHERE id='$content_id'",$db);
	@mysql_query("INSERT INTO user_like (user_ip,user_list) values (INET_ATON('$user_ip'),'$insert_list')",$db);	
}

else
{
	$list_res = mysql_query("SELECT user_list FROM user_like WHERE user_ip=INET_ATON('$user_ip')",$db);
	$list_row = mysql_fetch_array($list_res);
	$list_id = strpos($list_row[user_list], "|".$content_id."|,");
		
	if($list_id === false)
	{
		$update_list = $list_row[user_list]."|".$content_id."|,";
		@mysql_query("UPDATE content SET the_like=the_like+1 WHERE id='$content_id'",$db);
		@mysql_query("UPDATE user_like SET user_list='$update_list' WHERE user_ip=INET_ATON('$user_ip')",$db);
	}
}

mysql_close($db);
exit();

?>