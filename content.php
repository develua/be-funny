<? session_start(); define("INC_SCAN","1");

include("options.inc.php");

$id = $_POST[id];

if(isset($_POST[submit]) && !empty($id) && $_SESSION[POST_RES] != true)
{
	$result = mysql_query("DELETE FROM test WHERE id='$id'",$db);
	
	if($result == true)
	{
		$result_text = "Данные успешно уалены из базы данных";
		$result_style = 'style="color: #090; padding: 15px; border: 1px solid #D9E0E7; text-align: center;"';
	}
	
	else
	{
		$result_text = "Данные не были удалены из базы данных";
		$result_style = 'style="color: #900; padding: 15px; border: 1px solid #D9E0E7; text-align: center;"';
	}
	
	$_SESSION[POST_RES] = "true";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Документ без названия</title>
<style>
body {
font: 13px/18px Verdana, Tahoma, Arial, sans-serif;
color: #575757;
}

#block {
width: 500px;
margin: 200px auto 0 auto;
padding: 20px;
background: #F6F6F6;
border: 1px solid #D9E0E7;
}

input {
padding: 2px 5px;
float: right;
margin: 20px 0 0 0;
border: 1px solid #D9E0E7;
background: #FFF;
color: #246B99;
}

#result {
width: 500px;
margin: 20px auto;
padding: 20px;
border: 1px solid #D9E0E7;
}
</style>
</head>
<body>
<div id="block">
<?
$res = mysql_query("SELECT * FROM test ORDER BY RAND()",$db);
$row = mysql_fetch_array($res);

echo $row[text];
?>
	<div>
		<form action="content.php" method="POST">
        	<input name="id" type="hidden" value="<?=$row[id]?>">
	    	<input name="submit" type="submit" value="Удалить">
	    </form>
	</div>
</div>
<?
if(!empty($result_style) && !empty($result_text) && $_SESSION[POST_RES] == true)
{
	echo('<div id="result" '.$result_style.'>'.$result_text.'</div>');
}

unset($_SESSION[POST_RES]);
?>
</body>
</html>