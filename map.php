<? define("INC_SCAN","1");

include("header.inc.php");

$url_page = string_slash($_GET[page]);
$error_url_page = reg_expres($url_page, 1, 2, "/^[0-9]{1,2}$/");

if($error_url_page == true){
	$page = 1;
}

echo('<div class="mapContent">');

if($page == 1)
{
echo <<<HTML
	<div id="mapTop">
        <div><a href="/">Главная страница</a></div><div><a href="map.php">Карта сайта</a></div>
	</div>
HTML;
}

$count_res = mysql_query("SELECT COUNT(id) FROM content");
$count_row = mysql_fetch_row($count_res);
$count_record = $count_row[0];

$page_all = ceil($count_record / $limit_record);

$start_num = 2;
$limit_record = 100;

if($url_page >= 2)
{
	$start_num =  $url_page * 100 - 99;
	
	if($page_all < ($url_page * 100))
	{
		$limit_record = $page_all;
	}
}

for($i = $start_num; $i <= $limit_record; $i++)
{
	echo('<div class="mapMiddle"><a href="page_'.$i.'.html">Страница '.$i.'</a></div>');
}

echo('</div><div id="navigation"><a href="/map.php">1</a><a href="/map.php?page=2">2</a></div>');

include("footer.inc.php");

?>