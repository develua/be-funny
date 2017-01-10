<? define("INC_SCAN","1");

include("options.inc.php");

$password = string_slash($_GET[password]);

if($myPassword != $password)
{
	header("Status: 404 Not Found");
	header("Location: /error.php");
	mysql_close($db);
	exit();
}

$count_res = mysql_query("SELECT COUNT(id) FROM content");
$count_row = mysql_fetch_row($count_res);
$count_record = $count_row[0];

$page_all = ceil($count_record / $limit_record);
$name = "page_".$page_all.".html";

$name_file = "sitemap.xml";
$str = '<url>
  <loc>http://be-funny.ru/page_'.$page_all.'.html</loc>
  <priority>0.9</priority>
</url>
</urlset>';


$file = file($name_file);
$count = count($file);

for($i = 1; $i < $count; $i++)
{
	if(strpos($file[$i], $name))
	{
		$result = true;
	}
}

if($result != true)
{
	echo('<div align="center" style="color: #090">Запись в файл произошла успешно! Совпадений не найденно.</div>');
	
	$num = $count - 1;
	
	for($i = 1; $i < sizeof($file); $i++)
	{
		if($i == $num)
		{
			unset($file[$i]);
		}
	}
	
	$fp = fopen($name_file, "w");
	fputs($fp, implode("", $file));
	$fp = fopen($name_file, "a+");
	fputs($fp, $str);
	$fp = file($name_file);
	
	echo('<p align="center"><textarea cols="100" rows="40">');
	
	for($i = 1; $i < count($fp); $i++)
	{
		echo($fp[$i]);
	}
	
	echo('</textarea></p>');
}
else
{
	echo('<div align="center" style="color: #900">Запись в файл не произошла! Совпадение найденно.</div>');
}

mysql_close($db);
exit();

?>