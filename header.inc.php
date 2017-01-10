<? defined("INC_SCAN") or die(header("Location: /error.php"));

include("options.inc.php");

if(!stristr($http_user_agent, "MSIE 7.0"))
{
	if(stristr($http_user_agent, "MSIE 6.0") || stristr($http_user_agent, "MSIE 5.01"))
	{
		header("Location: /explorer.php");
		mysql_close($db);
		exit();
	}
}

echo <<<HTML
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>$title</title>
<meta name="description" content="$description">
<meta name="keywords" content="$keywords">
<meta http-equiv="content-language" content="ru">
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="/img/favicon.ico">
<link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml">
<link type="text/css" rel="stylesheet" href="/css/reset.css">
<link type="text/css" rel="stylesheet" href="/css/style.css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/script.js"></script>
<script type="text/javascript" src="/js/tooltipsy.js"></script>
</head>
<body>

<!--Начало блока Header-->
<div id="header">
	<div id="logoBlock">
    	<h1><a href="http://$http_host/" title="Колекция цитат и статусов">$host_name</a></h1>
        <h2>Коллекция цитат и статусов</h2>
    </div>
    <div id="bannerTop">
    	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Баннерная реклама 468x60 -->
			<ins class="adsbygoogle"
			style="display:inline-block;width:468px;height:60px"
			data-ad-client="ca-pub-6993321457349830"
			data-ad-slot="2630442020"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
    </div>
</div>
<!--Конец блока Header-->

<div id="wrapper">

<!--Начало блока MainBlock-->
<div id="mainBlock">
HTML;

?>