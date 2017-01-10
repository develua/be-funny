<? define("INC_SCAN","1");

header("Content-type: text/html; charset=windows-1251");

if($_SERVER[HTTP_HOST] != "be-funny.ru")
{
	header("Location: /error.php");
	mysql_close($db);
	exit();
}

include("options.inc.php");

$count_res = mysql_query("SELECT COUNT(id) FROM fact");
$count_row = mysql_fetch_row($count_res);

$limit_one = floor(($count_row[0] - 1) / 3);
$array_max = array(1 => $limit_one, 2 => $limit_one * 2, 3 => $limit_one * 3);
$array_min = array(1 => 0, 2 => $limit_one, 3 => $limit_one * 2);

for($i = 1; $i <= 3; $i++)
{
	$rand = mt_rand($array_min[$i],$array_max[$i]);
	
	$fact_res = mysql_query("SELECT id, text FROM fact LIMIT $rand, 1",$db);
	$fact_row = mysql_fetch_array($fact_res);
	
	echo('<div class="rightContent">
		<span>Вы знали, что?</span>
    	'.$fact_row[text].'
    </div>');
}

mysql_close($db);
exit();

?>