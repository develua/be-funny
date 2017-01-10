<? define("INC_SCAN","1");

$url_page = $_SERVER[REQUEST_URI];
if(strpos($url_page, "page_") === false || strpos($url_page, ".html") === false)
{
	if($url_page != "/")
	{
		header("Status: 404 Not Found");
		header("Location: /error.php");
		exit();
	}
}

include("header.inc.php");

$url_page = string_slash($_SERVER[REQUEST_URI]);
$user_ip = string_slash($_SERVER[REMOTE_ADDR]);

$error_url_page = reg_expres($url_page, 12, 20, "/^\/page_[0-9]{1,10}\.html$/");
$error_user_ip = reg_expres($user_ip, 9, 15, "/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/");

$num_page = explode("_", $url_page);
$page = explode(".", $num_page[1]);
$page = $page[0];

if($request_url == "/"){
	$page = 1;
	$url_page = "mainPage";
}

$count_res = mysql_query("SELECT COUNT(id) FROM content");
$count_row = mysql_fetch_row($count_res);
$count_record = $count_row[0];

$start_num = 0;
$page_all = ceil($count_record / $limit_record);

if($page != 1)
{
	$start_num = ($limit_record * $page) - $limit_record;
}

if($error_user_ip == true || $page_all < $page || $error_url_page == true && $url_page != "mainPage")
{	
	echo('<script type="text/javascript">
		$(location).attr("href","/error.php");
	</script>');
	mysql_close($db);
	exit();
}

if($request_url == "/"){
	echo('<div class="mainContent" id="disableSelection">
		<div id="hideBox" class="hasTip" title="Скрыть"></div>
		<p class="mainBr">Статусы – это неотъемлемая часть социальных сетей. Эти короткие высказывания, афоризмы, помогают людям выразить своё настроение, сообщить друзьям о своих мыслях и желаниях. Красивый интересный статус привлекает внимание к странице, он может либо поднять настроение человеку, который его читает, либо наоборот, заставит задуматься о жизни. Часто статусы представляют собой цитаты из известных (или не очень известных) философских и художественных произведений, стихотворений. В некоторых случаях в качестве статусов выступают интересные факты.</p>
		<p class="mainBr">Конечно же, огромной популярностью пользуются статусы о любви. Обычно такие высказывания размещают на своей страничке влюблённые девушки. Мужчины тоже часто прибегают к цитированию афоризмов. Правда, обычно они более философские или смешные. Это не удивительно – мужчина старается привлечь внимание к себе, поэтому в первую очередь обращает внимание на яркость высказывания.</p>
		<p>Статусы и цитаты всех видов вы найдёте на нашем сайте. Мы стараемся регулярно пополнять свою коллекцию метких высказываний. Сотни страниц сконцентрированной мудрости и юмора помогут вам подобрать именно ту цитату, которая в данный момент наилучшим образом выражает ваши чувства.</p>
	</div>');
}

$list_res = mysql_query("SELECT user_list FROM user_like WHERE user_ip=INET_ATON('$user_ip')",$db);
$list_row = mysql_fetch_array($list_res);

$content_res = mysql_query("SELECT * FROM content LIMIT $start_num, $limit_record",$db);
while($content_row = mysql_fetch_array($content_res))
{
	$list_id = strpos($list_row[user_list], "|".$content_row[id]."|,");
	
	if($list_id === false)
	{
		$lake_class = "likeBox";
	}
	else
	{
		$lake_class = "likeBoxOff";
	}
	
	if(mb_strlen($content_row[text]) < 90)
	{
		$align_vertical = ' alignVertical';
	}
	
	echo('<div class="mainContent'.$align_vertical.'">
		<div id="'.$content_row[id].'" class="'.$lake_class.' hasTip" title="'.$content_row[the_like].'"></div>
		'.$content_row[text].'
	</div>');
	
	$align_vertical = "";
}

if($page - 4 > 0 && $page < 4 || $page == $page_all && $page - 4 > 0)
{
	$page_left_5 = '<a href="/page_'.($page - 4).'.html">'.($page - 4).'</a>';
}
if($page - 3 > 0 && $page < 3 || $page == $page_all && $page - 3 > 0 || $page == $page_all - 1 && $page > 3)
{
	$page_left_4 = '<a href="/page_'.($page - 3).'.html">'.($page - 3).'</a>';
}
if($page - 2 > 0)
{
	$page_left_3 = '<a href="/page_'.($page - 2).'.html">'.($page - 2).'</a>';
	if($page - 2 == 1)
	{
		$page_left_3 = '<a href="/">1</a>';
	}
}
if($page - 1 > 0)
{
	$page_left_2 = '<a href="/page_'.($page - 1).'.html">'.($page - 1).'</a>';
	if($page - 1 == 1)
	{
		$page_left_2 = '<a href="/">1</a>';
	}
}
if($page + 1 <= $page_all)
{
	$page_right_2 = '<a href="/page_'.($page + 1).'.html">'.($page + 1).'</a>';
}
if($page + 2 <= $page_all)
{
	$page_right_3 = '<a href="/page_'.($page + 2).'.html">'.($page + 2).'</a>';
}
if($page + 3 <= $page_all && $page < 3)
{
	$page_right_4 = '<a href="/page_'.($page + 3).'.html">'.($page + 3).'</a>';
}
if($page + 4 <= $page_all && $page < 2)
{
	$page_right_5 = '<a href="/page_'.($page + 4).'.html">'.($page + 4).'</a>';
}

if($page_all > 1)
{
	echo('<div id="navigation">'.$page_left_5.$page_left_4.$page_left_3.$page_left_2.'<span>'.$page.'</span>'.$page_right_2.$page_right_3.$page_right_4.$page_right_5.'</div>');
}

include("footer.inc.php");

?>